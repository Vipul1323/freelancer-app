<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleArray = ['Client','Designer'];
        foreach($roleArray as $key => $role){
            $roleObj = Role::where('name',$role)->first();
            if(empty($roleObj)){
                $roleObj = new Role();
                $roleObj->name = $role;
                $roleObj->guard_name = "web";
                $roleObj->save();
            }

        }
    }
}
