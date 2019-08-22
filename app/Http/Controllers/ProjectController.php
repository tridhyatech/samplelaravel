<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Cr;
use Mail;
use App\ProjectType;
use App\ProjectUser;
use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        if (Auth::check() && Auth::user()->hasPermission('projects.listing')) {
            $projectsData = $searchFilter = array();

            if ($request->isMethod('post')) {
                if($request->has('project_type')){
                    $searchFilter['project_type'] = $request->post('project_type');
                }
                if($request->has('project_status')){
                    $searchFilter['project_status'] = $request->post('project_status');
                }
            }
            
            $project = new Project();
            $projectsData = $project->getProjectList($searchFilter);

            $projectType = new ProjectType();
            $projectTypeData = $projectType->getProjectTypeList();
            
            return view('pms.projects.index', compact('projectsData', 'projectTypeData', 'searchFilter'));
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->hasPermission('projects.create')) {
            $user = new User();
            $accountManagerList = $user->getUserListByDesignation(16);     //16 - Business Development Manager Role
            $projectManagerList = $user->getUserListByDesignation(2);     //2 - project manager role
            $projectUserList = $user->getProjectUserList();
            
            $projectType = new ProjectType();
            $projectTypeData = $projectType->getProjectTypeList();

            return view('pms.projects.create', compact('projectTypeData','accountManagerList','projectManagerList', 'projectUserList'));
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->hasPermission('projects.create')) {
            $rules = array(
                'project_name' => 'required',
                'client_name' => 'required',
                'account_manager' => 'required|integer',
                'project_manager' => 'required|integer',
                'project_type' => 'required|integer',
                'project_status' => 'required|integer',
                'project_users' => 'required|min:1',
                'project_users.*' => 'required|distinct|min:1',
            );
            if(Input::get('project_type') == 1){
                $rules['estimated_hours'] = 'required|numeric';
                $rules['project_end_date'] = 'required|date_format:Y-m-d|after_or_equal:project_start_date';
            }
            if(Input::get('project_end_date') != ''){
                $rules['project_start_date'] = 'required|date_format:Y-m-d|before_or_equal:project_end_date';
            }else{
                $rules['project_start_date'] = 'required|date_format:Y-m-d';
            }
            $validator = Validator::make(Input::all(), $rules);

            // if validation fails
            if ($validator->fails()) {
                return Redirect::to('pms/projects/create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // store
                $project = new Project;
                $project->project_name = Input::get('project_name');
                $project->client_name = Input::get('client_name');
                $project->account_manager = Input::get('account_manager');
                $project->project_manager = Input::get('project_manager');
                if(Input::get('estimated_hours') != ''){
                    $project->estimated_hours = Input::get('estimated_hours');
                }
                $project->project_type = Input::get('project_type');
                $project->project_start_date = date("Y-m-d", strtotime(Input::get('project_start_date')));
                if(Input::get('project_end_date') != ''){
                    $project->project_end_date = date("Y-m-d", strtotime(Input::get('project_end_date')));
                }
                $project->project_status = Input::get('project_status');
                $project->save();

                if($project->id && !empty(Input::get('project_users'))){
                    $projectUserArray = Input::get('project_users');
                    $projectID = $project->id;

                    foreach ($projectUserArray as $userID) {
                        $projectUser = new ProjectUser;
                        $projectUser->project_id = $projectID;
                        $projectUser->user_id = $userID;
                        $projectUser->save();
                    }
                }

                $projectData = $project->getProjectData($projectID);

                $projectStatusArray = config('constant.project_status');
                $projectStatus = $projectStatusArray[$projectData['project_status']];

                $session = session()->all();
                $loggedInUserID = isset($session['user_id']) ? intval($session['user_id']) : 0;

                $userData = new User();
                $assigned_user = array();
                foreach ($projectData['projectuser'] as $value) {
                    $assigned_user_details = $userData->getUserDetails($value['user_id']);
                    $assigned_user[] = $assigned_user_details['first_name'].' '.$assigned_user_details['last_name'];
                }

                $loggedInUserDetails = $userData->getUserDetails($loggedInUserID);
                $loggedInUserName = $loggedInUserDetails['first_name'].' '.$loggedInUserDetails['last_name'];

                $emailData = array();
                $emailData['id'] = $projectID;
                $emailData['project_name'] = $projectData['project_name'];
                $emailData['project_type'] = $projectData['project_type_name'];
                $emailData['project_start_date'] = date('jS F, Y', strtotime($projectData['project_start_date']));
                $emailData['project_end_date'] = date('jS F, Y', strtotime($projectData['project_end_date']));
                $emailData['estimated_hours'] = $projectData['estimated_hours'];
                $emailData['client_name'] = $projectData['client_name'];
                $emailData['account_manager'] = $projectData['account_manager_name'];
                $emailData['project_manager'] = $projectData['project_manager_name'];
                $emailData['project_status'] = $projectStatus;
                $emailData['assigned_user'] = $assigned_user;
                $emailData['loggedInUserName'] = $loggedInUserName;

                Mail::send('emails.project_created', $emailData, function($message) use($projectData, $emailData)
                {
                    $message->from(config('constant.tridhya_mail'), $emailData['loggedInUserName']);
                    $message->to(config('constant.pm_email'),"Sagar Shah")->subject('New project created');
                    //$message->cc(config('constant.cc_emails'));
                });
                
                // redirect
                Session::flash('success', 'Project Successfully Created!');
                if ($loggedInUserID == 4 || $loggedInUserID == 1) {
                    return Redirect::to('pms/projects');
                } else {
                    return Redirect::to('pms/projects/myprojects');
                }
            }
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->hasPermission('projects.edit')) {
            $project = new Project();

            $projectDetails = $project->getProjectDetails($id);

            if(isset($projectDetails['projectuser']) && !empty($projectDetails['projectuser'])){
                $userArray = array();
                foreach($projectDetails['projectuser'] as $projectUserDetail){
                    $userArray[] = $projectUserDetail['user_id'];
                }

                $projectDetails['project_users'] = $userArray;
            }

            $user = new User();
            $accountManagerList = $user->getUserListByDesignation(16);     //16 - Business Development Manager Role
            $projectManagerList = $user->getUserListByDesignation(2);     //2 - project manager role
            $projectUserList = $user->getProjectUserList();

            $projectType = new ProjectType();
            $projectTypeData = $projectType->getProjectTypeList();

            return view('pms.projects.edit', compact('projectTypeData','projectDetails','accountManagerList','projectManagerList', 'projectUserList'));
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->hasPermission('projects.edit')) {
            $rules = array(
                'project_name' => 'required',
                'client_name' => 'required',
                'account_manager' => 'required|integer',
                'project_manager' => 'required|integer',
                'estimated_hours' => 'required|numeric',
                'project_type' => 'required|integer',
                'project_start_date' => 'required|date_format:Y-m-d|before_or_equal:project_end_date',
                'project_start_date' => 'required|date_format:Y-m-d',
                'project_status' => 'required|integer',
            );
            $validator = Validator::make(Input::all(), $rules);   

            if ($validator->fails()) {
                return Redirect::to('pms/projects/edit/'.$id)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // store
                $project = Project::find($id);
                $project->project_name = Input::get('project_name');
                $project->client_name = Input::get('client_name');
                $project->account_manager = Input::get('account_manager');
                $project->project_manager = Input::get('project_manager');
                $project->estimated_hours = Input::get('estimated_hours');
                $project->project_type = Input::get('project_type');
                $project->project_start_date = date("Y-m-d", strtotime(Input::get('project_start_date')));
                $project->project_end_date = date("Y-m-d", strtotime(Input::get('project_end_date')));
                $project->project_status = Input::get('project_status');
                $project->save();

                if($id && !empty(Input::get('project_users'))){
                    $projectUserArray = Input::get('project_users');
                    $projectID = $id;

                    $deletedRows = ProjectUser::where('project_id', '=', $projectID)->delete();

                    foreach ($projectUserArray as $userID) {
                        $projectUser = new ProjectUser;
                        $projectUser->project_id = $projectID;
                        $projectUser->user_id = $userID;
                        $projectUser->save();
                    }
                }

                // redirect
                Session::flash('success', 'Project Successfully Updated!');
                return Redirect::to('pms/projects');
            }
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->hasPermission('projects.delete')) {
            $project = Project::find($id);
            $project->delete();

            Session::flash('success', 'Project Successfully Deleted!');
            return Redirect::to('pms/projects');
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }

    public function myProjects(Request $request)
    {     
        $projectsData = $userIdArray = $searchFilter = $totalEstimatedHours = array();
        $session = session()->all();
        $loggedInUserID = isset($session['user_id']) ? intval($session['user_id']) : 0;
        if($loggedInUserID){
            $searchFilter['user_ids'] = array($loggedInUserID);
        }

        if ($request->isMethod('post')) {
            if($request->has('project_type')){
                $searchFilter['project_type'] = $request->post('project_type');
            }
            if($request->has('project_status')){
                $searchFilter['project_status'] = $request->post('project_status');
            }
        } else {
            $searchFilter['project_type'] = $request->post('project_type');
            $searchFilter['project_status'] = '1';
        }
        
        $project = new Project();
        $projectsData = $project->getUserProjects($searchFilter);

        $projectType = new ProjectType();
        $projectTypeData = $projectType->getProjectTypeList();
        $percentage = array();
        $cr = new Cr();
        foreach ($projectsData as $projectValue) {
            $crData[$projectValue['id']] = $cr->getCrTotalHours($projectValue['id']);
            $totalEstimatedHours[$projectValue['id']]  = $projectValue['estimated_hours'] + $crData[$projectValue['id']];
            
            if($totalEstimatedHours[$projectValue['id']] != 0){
                $percentage[$projectValue['id']] = round((( $projectValue['total_logged_hours'])/($totalEstimatedHours[$projectValue['id']]))* 100);
            }else{
                if($projectValue['total_logged_hours'] !=0){
                    $percentage[$projectValue['id']] = 'NA';
                }else{
                    $percentage[$projectValue['id']] = 0;
                }
            }
        }
        
        return view('pms.projects.my_projects', compact('totalEstimatedHours','projectsData', 'projectTypeData', 'searchFilter','percentage'));
    }

    public function teamProjects()
    {        
        $projectsData = $userIdArray = array();
        $session = session()->all();
        $loggedInUserID = isset($session['user_id']) ? intval($session['user_id']) : 0;
        
        $user = new User();
        $myTeamList = $user->getMyTeamList($loggedInUserID);

        if(!empty($myTeamList)){
            foreach ($myTeamList as $userDetail) {
                $userIdArray[] = $userDetail['id'];
            }
        }

        $project = new Project();
        $projectsData = $project->getUserProjects($userIdArray);
        
        return view('pms.projects.my_team_projects', compact('projectsData'));
    }

    public function myTeam()
    {        
        $projectsData = $userIdArray = array();
        $session = session()->all();
        $loggedInUserID = isset($session['user_id']) ? intval($session['user_id']) : 0;
        
        $user = new User();
        $myTeamList = $user->getMyTeamList($loggedInUserID);
        
        if(!empty($myTeamList)){
            foreach ($myTeamList as $userDetail) {
                $userIdArray[] = $userDetail['id'];
            }
        }

        $project = new Project();
        $projectsData = $project->getUserProjects($userIdArray);
        
        return view('pms.projects.my_team_projects', compact('myTeamList', 'projectsData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function assignUsers($id)
    {
        if (Auth::check() && Auth::user()->hasPermission('projects.assign')) {
            $project = new Project();

            $projectDetails = $project->getProjectDetails($id);

            if(isset($projectDetails['projectuser']) && !empty($projectDetails['projectuser'])){
                $userArray = array();
                foreach($projectDetails['projectuser'] as $projectUserDetail){
                    $userArray[] = $projectUserDetail['user_id'];
                }

                $projectDetails['project_users'] = $userArray;
            }

            $user = new User();
            $projectUserList = $user->getProjectUserList();

            return view('pms.projects.assign_users', compact('projectDetails', 'projectUserList'));
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function updateProjectUsers(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->hasPermission('projects.assign')) {
            if($id && !empty(Input::get('project_users'))){
                $projectUserArray = Input::get('project_users');
                $projectID = $id;

                $deletedRows = ProjectUser::where('project_id', '=', $projectID)->delete();

                foreach ($projectUserArray as $userID) {
                    $projectUser = new ProjectUser;
                    $projectUser->project_id = $projectID;
                    $projectUser->user_id = $userID;
                    $projectUser->save();
                }

                Session::flash('success', 'Project Users Successfully Updated!');
                return Redirect::to('pms/projects/myprojects');
            }else{
                Session::flash('error', 'Please select project users');
                return Redirect::to('pms/projects/assignusers/'.$id);
            }
        }else{
            Session::flash('error', 'You do not have permission to perform this action!');
            return Redirect::to('pms/dashboard');
        }
    }
}
