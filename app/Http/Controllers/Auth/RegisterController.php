<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {

        $data = $request->all();
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'country_code' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
            'role' => ['required'],
        ]);

        $userObj = User::where('email',$data['email'])->first();
        if(empty($userObj)){
            $userObj = new User();
        }
        $userObj->name = $data['name'];
        $userObj->email = $data['email'];
        $userObj->country_code = $data['country_code'];
        $userObj->phone = $data['phone'];
        $userObj->password = Hash::make($data['password']);

        if($request->hasFile('profile_picture')){
            $file                   = $data['profile_picture'];
            $filename               = time()."-".$file->getClientOriginalName();
            $destinationPath        = public_path().'/uploads/avatar/';
            $upload                 = $file->move($destinationPath, $filename);
            if(!empty($userObj->avatar) && file_exists(public_path('uploads/avatar/'.$userObj->avatar))){
                unlink(public_path('uploads/avatar/'.$userObj->avatar));
            }
            $userObj->avatar         = $filename;
        }

        if($userObj->save()){
            $userObj->assignRole($data['role']);
            $request->session()->flash('status',__('You have successfully registered'));
            return redirect('/home');
        }else{
            $request->session()->flash('error',__('Unable to create your profile. Please try again'));
            return redirect()->back()->withInput();
        }
    }
}
