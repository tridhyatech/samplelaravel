<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{    
    use SoftDeletes;

    protected $table = 'projects';

    public function projecttype(){
        return $this->hasOne(ProjectType::class, 'id', 'project_type');
    }  

    public function accountmanager(){
        return $this->hasOne(User::class, 'id', 'account_manager');
    } 

    public function projectmanager(){
        return $this->hasOne(User::class, 'id', 'project_manager');
    }

    public function projectuser(){
        return $this->hasMany(ProjectUser::class, 'project_id', 'id');
    }

    public function projecttask(){
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function getProjectList($searchFilter = array()){
        $query = Project::select("projects.id","projects.project_name","projects.project_status","projects.client_name","projects.project_type","projects.project_start_date","projects.project_end_date", "projects.estimated_hours","project_types.project_type_name", DB::raw("CONCAT(u1.first_name,' ',u1.last_name) as account_manager_name"), DB::raw("CONCAT(u2.first_name,' ',u2.last_name) as project_manager_name"), "te.log_hours", DB::raw("SUM(te.log_hours) As total_logged_hours"));
        $query->join('project_types', 'projects.project_type', '=', 'project_types.id');
        $query->leftJoin('users as u1', 'projects.account_manager', '=', 'u1.id');
        $query->leftJoin('users as u2', 'projects.project_manager', '=', 'u2.id');
        $query->leftJoin('tasks as t', 'projects.id', '=', 't.project_id');
        $query->leftJoin('task_entries as te', 'te.task_id', '=', 't.id');

        if(isset($searchFilter['project_type'])){
            $query->where('project_type', $searchFilter['project_type']);
        }
        if(isset($searchFilter['project_status'])){
            $query->where('project_status', $searchFilter['project_status']);
        }
        $userIDs = isset($searchFilter['user_ids']) ? $searchFilter['user_ids'] : array();
        if(isset($userIDs) && !empty($userIDs)){
            $query->join("project_users",function($join) use($userIDs){
                        $join->on("project_users.project_id","=","projects.id")
                            ->whereIn("project_users.user_id", $userIDs);
            });
        }
        $query->groupBy('projects.id');
        $projectData = $query->get()->toArray();

        return $projectData;
    }

    public function getUserProjects($searchFilter = array())
    {
        $projects = array();
        $userIDs = isset($searchFilter['user_ids']) ? $searchFilter['user_ids'] : array();
        if(isset($userIDs) && !empty($userIDs)){
            $query = Project::select("projects.*","project_users.user_id as user_id", "project_types.project_type_name", DB::raw("CONCAT(u1.first_name,' ',u1.last_name) as account_manager_name"), DB::raw("CONCAT(u2.first_name,' ',u2.last_name) as project_manager_name"), "te.log_hours", DB::raw("SUM(te.log_hours) As total_logged_hours"));
            $query->join("project_users",function($join) use($userIDs){
                    $join->on("project_users.project_id","=","projects.id")
                        ->whereIn("project_users.user_id", $userIDs)
                        ->whereNull('project_users.deleted_at');
                });
            $query->join('project_types', 'projects.project_type', '=', 'project_types.id');
            $query->leftJoin('users as u1', 'projects.account_manager', '=', 'u1.id');
            $query->leftJoin('users as u2', 'projects.project_manager', '=', 'u2.id');
            $query->leftJoin('tasks as t', 'projects.id', '=', 't.project_id');
            $query->leftJoin('task_entries as te', function($join) {
                $join->on('te.task_id', '=', 't.id');
                $join->where('te.deleted_at', null); 
            });

            if(isset($searchFilter['project_type'])){
                $query->where('project_type', $searchFilter['project_type']);
            }
            if(isset($searchFilter['project_status'])){
                $query->where('project_status', $searchFilter['project_status']);
            }

            $query->groupBy('projects.id');
            $projects = $query->get()->toArray();
        }
        return $projects;
    }

    public function getProjectDetails($projectID){
        $project = Project::query()->with('projectuser');
        if ($projectID) {
            $project->where('id', $projectID);
        }

        $projectDetail = $project->first()->toArray();

        return $projectDetail;
    }

    public function getProjectData($projectID){
        $project = Project::select("projects.*", "project_types.project_type_name", DB::raw("CONCAT(u1.first_name,' ',u1.last_name) as account_manager_name"), DB::raw("CONCAT(u2.first_name,' ',u2.last_name) as project_manager_name"))->with('projectuser');
        $project->join('project_types', 'projects.project_type', '=', 'project_types.id');
        $project->leftJoin('users as u1', 'projects.account_manager', '=', 'u1.id');
        $project->leftJoin('users as u2', 'projects.project_manager', '=', 'u2.id');
        if ($projectID) {
            $project->where('projects.id', $projectID);
        }
        $projectDetail = $project->first()->toArray();

        return $projectDetail;
    }

    public function delete()
    {
        // delete all related photos 
        $this->projectuser()->delete();
        $this->projecttask()->delete();
        // as suggested by Dirk in comment,
        // it's an uglier alternative, but faster
        // Photo::where("user_id", $this->id)->delete()

        // delete the user
        return parent::delete();
    }
   
}
