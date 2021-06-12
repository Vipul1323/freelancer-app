<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'title', 'description', 'due_date','assigned_to','user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'deleted_by',
    ];

    public static function boot(){
        parent::boot();

        static::created(function ($projectObj) {
            if(empty($projectObj->project_id)){
                $projectObj->project_id    = intval(abs(generateUniqueId().$projectObj->id));
                $projectObj->save();
            }
        });
    }

    public function User(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function AssignedTo(){
        return $this->hasOne('App\User','id','assigned_to');
    }

    public function ProjectHasFiles(){
        return $this->hasMany('App\ProjectHasFiles','project_id');;
    }

    public function ProjectHasNotes(){
        return $this->hasMany('App\ProjectHasNotes','project_id');;
    }

    public function syncFiles($request){
        if($request->hasFile('files')){
            $files = $request->files;
            foreach($files as $key => $file){
                foreach($file as $key1 => $fileObj){
                    $filename               = time()."-".$fileObj->getClientOriginalName();
                    $destinationPath        = public_path().'/uploads/projects/';
                    $upload                 = $fileObj->move($destinationPath, $filename);

                    $projectFilesObj               = new ProjectHasFiles();
                    $projectFilesObj->project_id   = $this->id;
                    $projectFilesObj->user_id      = Auth::user()->id;
                    $projectFilesObj->file_name    = $filename;
                    $projectFilesObj->save();
                }
            }
        }
    }

    public function hasAccess(){
        if(Auth::user()->id == $this->user_id || Auth::user()->id == $this->assigned_to){
            return true;
        }
        return false;
    }
}
