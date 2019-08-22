<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectUser extends Model
{
    use SoftDeletes;

    protected $table = 'project_users'; 
    
    public function user(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function getProjectUsers($projectID){
        $projectUser = ProjectUser::query()->with(['user']);

    	if ($projectID) {
            $projectUser->where('project_id', $projectID);
        }

        $projectData = $projectUser->orderBy('id','ASC')->get()->toArray();
        
        return $projectData;
    }
    
    // get projects name
    public function projectList(){
        return $this->hasOne('App\Project', 'id', 'project_id')->select('id','project_name');
    }

}
