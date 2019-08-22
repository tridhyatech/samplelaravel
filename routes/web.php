<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pms.login');
});
Route::match(['get','post'],'/pms','UserFrontController@login');
Route::get('/admin', function () {
    return view('admin.admin_login');
});
Route::match(['get','post'],'/admin','AdminController@login');
Auth::routes();
Route::group(['middleware'=>['auth']],function(){
    Route::get('/admin/dashboard','AdminController@dashboard');
    Route::match(['get','post'],'/admin/settings','AdminController@settings');
    Route::match(['get','post'],'/admin/viewtimesheet','PmsController@viewTimesheet');
    Route::match(['get','post'],'/admin/viewsummary','PmsController@viewSummary');
});

Auth::routes();
Route::group(['middleware'=>['auth']],function(){
    Route::get('/pms/users','UserController@index');
    Route::match(['get','post'],'/pms/users/create','UserController@create');
    Route::post('/pms/users/store','UserController@store');
    Route::get('/pms/users/edit/{id}','UserController@edit');
    Route::post('/pms/users/update/{id}','UserController@update');
    Route::get('/pms/users/destroy/{id}','UserController@destroy');
    Route::get('pms/logout','UserFrontController@logout');
    Route::get('/pms/dashboard','UserFrontController@dashboard');
    Route::get('/pms/requesttimesheet','PmsFrontController@requesttimesheet');
    Route::match(['get','post'],'/late-users-data','PmsController@getLateUsersData');
    Route::match(['get','post'],'/pms/viewtimesheet','PmsController@viewTimesheet');
    Route::match(['get','post'],'/pms/viewsummary','PmsController@viewSummary');
    Route::match(['get','post'],'/pms/gettimeentry','PmsController@getTimeEntry');
    Route::post('/pms/updatetimeentry','PmsController@updateTimeEntry');
    Route::match(['get','post'],'/pms/changepassword','UserFrontController@changePassword');
    Route::match(['get','post'],'/pms/viewprofile','UserFrontController@viewProfile');
    
    Route::match(['get','post'],'/pms/cr/all_cr','CrController@index');
    Route::get('/pms/cr/create/{id}','CrController@create');
    Route::post('/pms/cr/store/{id}','CrController@store');
    Route::get('/pms/cr/destroy/{id}','CrController@destroy');
    Route::get('/pms/cr/edit/{id}','CrController@edit');
    Route::post('/pms/cr/update/{id}','CrController@update');

    Route::match(['get','post'],'/pms/projects','ProjectController@index');
    Route::get('/pms/projects/edit/{id}','ProjectController@edit');
    Route::post('/pms/projects/update/{id}','ProjectController@update');
    Route::match(['get','post'],'/pms/projects/create','ProjectController@create');
    Route::post('/pms/projects/store','ProjectController@store');
    Route::get('/pms/projects/destroy/{id}','ProjectController@destroy'); 
    Route::match(['get','post'],'/pms/projects/myprojects','ProjectController@myProjects');
    Route::get('/pms/projects/teamprojects','ProjectController@teamProjects');
    Route::get('/pms/projects/myteam','ProjectController@myTeam');
    Route::get('/pms/projects/assignusers/{id}','ProjectController@assignUsers');
    Route::post('/pms/projects/updateusers/{id}','ProjectController@updateProjectUsers');

    Route::match(['get','post'],'/pms/tasks/index/{projecid?}','TaskController@index');
    Route::match(['get','post'],'/pms/tasks/create/{projecid}','TaskController@create');
    Route::post('/pms/tasks/store','TaskController@store');
    Route::get('/pms/tasks/edit/{taskid}','TaskController@edit');
    Route::post('/pms/tasks/update/{taskid}','TaskController@update');
    Route::get('/pms/tasks/destroy/{id}','TaskController@destroy'); 
    Route::match(['get','post'],'/pms/tasks/mytasks/{projecid?}','TaskController@myTasks');
    Route::match(['get','post'],'/pms/tasks/teamtasks','TaskController@teamTasks');
    Route::match(['get','post'],'/pms/tasks/myteam','TaskController@myTeam');
    Route::match(['get','post'],'/pms/tasks/uploadtasktimeentries','TaskEntryController@uploadTaskTimeEntries');

    Route::match(['get','post'],'/pms/gettaskentrylisting','TaskEntryController@getTaskEntryListing');
    Route::post('/pms/savetaskentry','TaskEntryController@saveTaskEntry');
    Route::match(['get','post'],'/pms/deletetaskentry','TaskEntryController@destroy');
    Route::match(['get','post'],'/pms/gettaskentrydetail','TaskEntryController@getTaskEntryDetail');
    Route::match(['get','post'],'/pms/teamtasksentries','TaskEntryController@teamTasksEntries');

    Route::get('/pms/designation','DesignationController@index');
    Route::get('/pms/designation/edit/{id}','DesignationController@edit');
    Route::post('/pms/designation/update/{id}','DesignationController@update');
    Route::get('/pms/designation/destroy/{id}','DesignationController@destroy');
    Route::match(['get','post'],'/pms/designation/create','DesignationController@create');
    Route::post('/pms/designation/store','DesignationController@store'); 

    Route::match(['get','post'],'/pms/uploadcsv','UploadcsvController@uploadcsv');
    Route::match(['get','post'],'/pms/uploadpms','PmsController@uploadpms');
    Route::match(['get','post'],'/pms/salarysliphtml','UploadcsvController@salarySlipHtml');

    Route::match(['get','post'],'/pms/leaverequests','LeaveController@index');
    Route::match(['get','post'],'/pms/leaverequests/{id}','LeaveController@index');
    Route::match(['get','post'],'/pms/leaves/add','LeaveController@create');
    Route::post('/pms/leaves/store','LeaveController@store');
    Route::get('/pms/leaves/approve/{id}','LeaveController@edit');
    Route::post('/pms/leaves/update/{id}','LeaveController@update');
    Route::get('/pms/leaves/destroy/{id}','LeaveController@destroy');
    Route::match(['get','post'],'/pms/teamleaves','LeaveController@teamLeaveRequests');

    Route::match(['get','post'],'/pms/holidays','HolidayController@index');
    Route::match(['get','post'],'/pms/holidays/create','HolidayController@create');
    Route::post('/pms/holidays/store','HolidayController@store');
    Route::get('/pms/holidays/edit/{id}','HolidayController@edit');
    Route::post('/pms/holidays/update/{id}','HolidayController@update');
    Route::get('/pms/holidays/destroy/{id}','HolidayController@destroy');
    
    Route::match(['get','post'],'/pms/compoffrequests','CompOffController@index');
    Route::match(['get','post'],'/pms/compoffs/add','CompOffController@create');
    Route::post('/pms/compoffs/store','CompOffController@store');
    Route::get('/pms/compoffs/destroy/{id}','CompOffController@destroy');
    Route::match(['get','post'],'/pms/teamcompoffs','CompOffController@teamCompoffRequests');
    Route::get('/pms/compoffs/approve/{id}','CompOffController@edit');
    Route::post('/pms/compoffs/update/{id}','CompOffController@update');
    Route::match(['get','post'],'/pms/compoffs/markedas/{id}','CompOffController@editMarkedAs');
    Route::match(['get','post'],'/pms/compoffs/updateMarkedAs/{id}','CompOffController@updateMarkedAs');
    
    Route::match(['get','post'],'/pms/users/uploadxlsx','UserController@uploadxlsx');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout','UserFrontController@logout');

Route::match(['get','post'],'/pms/forgotpassword','UserFrontController@forgotPassword');
Route::get('/pms/reporting/ajax/{id}','UserController@getReportingToAjax');
Route::get('/pms/reporting/update/{id}/{reporting_to}','UserController@setReportingTo');

