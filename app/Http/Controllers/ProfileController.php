<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
class ProfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function completeProfile(Request $request){
        $userObj = Auth::user();
        $formData = $request->all();
        if($request->isMethod('post')){

            Validator::make($formData, [
                'name' => ['required', 'string', 'max:255'],
                'country_code' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'profile_picture' => ['image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
                'role' => ['required'],
            ]);
            $userObj->name = $formData['name'];
            $userObj->country_code = $formData['country_code'];
            $userObj->phone = $formData['phone'];
            $userObj->password = Hash::make($formData['password']);

            if($request->hasFile('profile_picture')){
                $file                   = $formData['profile_picture'];
                $filename               = time()."-".$file->getClientOriginalName();
                $destinationPath        = public_path().'/uploads/avatar/';
                $upload                 = $file->move($destinationPath, $filename);
                $userObj->avatar         = $filename;
            }

            if($userObj->save()){
                $userObj->assignRole($formData['role']);
                $request->session()->flash('status',__('You have successfully completed your profile setup'));
                return redirect('/home');
            }else{
                $request->session()->flash('error',__('Unable to save your profile. Please try again'));
                return redirect()->back()->withInput();
            }
        }
        $roles = Role::pluck('name');
        return view('auth.complete_profile',compact('userObj','roles'));
    }
}
