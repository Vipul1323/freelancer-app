<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProjectHasNotes;
use App\Project;
use App\User;
use Auth;

class ProjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(Request $request){
        try {
             $projects = Project::where('user_id',Auth::user()->id)
                ->orWhere('assigned_to',Auth::user()->id)
                ->get();
            return view('projects.index',compact('projects'));
        } catch (\Exception $ex) {
            $request->session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
    }
}
