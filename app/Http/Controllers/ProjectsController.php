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

    public function newProject(Request $request){
        try {
            $formData = $request->all();
            if($request->isMethod('post')){

                $request->validate([
                    'title'         => 'required|string|max:255',
                    'description'   => 'required',
                    'due_date'      => 'required|date',
                    'assigned_to'   => 'required',
                    'files'         => 'max:5120'
                ]);

                $projectObj                 = new Project();
                $projectObj->user_id        = Auth::user()->id;
                $projectObj->title          = $formData['title'];
                $projectObj->description    = $formData['description'];
                $projectObj->due_date       = $formData['due_date'];
                $projectObj->assigned_to    = $formData['assigned_to'];
                if($projectObj->save()){
                    //Sync multiple files in project
                    $projectObj->syncFiles($request);

                    $request->session()->flash('status',__('Project is created successfully'));
                    return redirect('projects');
                }else{
                    $request->session()->flash('error',__('Unable to create project. Please try again'));
                    return redirect()->back()->withInput();
                }

            }
            $users = User::where('id','!=',Auth::user()->id)->pluck('name','id');
            return view('projects.new_project',compact('users'));
        } catch (\Exception $ex) {
            $request->session()->flash('error',$ex->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function viewProject($project_id,Request $request){
        try {
             $projectObj = Project::where('project_id',$project_id)
                ->first();
            if(empty($projectObj)){
                $request->session()->flash('error',__('Project not found'));
                return redirect()->back();
            }
            if(!$projectObj->hasAccess()){
                $request->session()->flash('error',__("You dont's have a permission to view this project"));
                return redirect()->back();
            }
            return view('projects.view_project',compact('projectObj'));
        } catch (\Exception $ex) {
            $request->session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
    }

}
