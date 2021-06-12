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
}
