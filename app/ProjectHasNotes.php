<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectHasNotes extends Model
{
    protected $table = 'projects_notes';

    public function User(){
        return $this->hasOne('App\User','id','user_id');;
    }

    public function Project(){
        return $this->hasOne('App\Project','id','project_id');;
    }
}
