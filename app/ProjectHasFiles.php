<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectHasFiles extends Model
{
    protected $table = 'projects_has_files';

    public function User(){
        return $this->hasOne('App\User','id','user_id');;
    }

    public function Project(){
        return $this->hasOne('App\Project','id','project_id');;
    }
}
