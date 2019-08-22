<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item {{ Request::is('pms/dashboard') ? 'selected' : '' }}"> 
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/pms/dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                @permission('users.listing|designation.listing')
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">User Management </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @permission('users.listing')
                        <li class="sidebar-item {{ Request::is('pms/users') ? 'selected' : '' }}"><a href="{{url('/pms/users')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Users Listing </span></a></li>
                        @endpermission
                        @permission('designation.listing')
                        <li class="sidebar-item {{ Request::is('pms/designation') ? 'selected' : '' }}"><a href="{{url('/pms/designation')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Designation Management </span></a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                <li class="sidebar-item {{ Request::is('pms/viewtimesheet') || Request::is('pms/viewtimesheet') ? 'selected' : '' }}"> 
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/pms/viewtimesheet')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">View Time Sheet</span></a>
                </li>
                @role('hr')
                @else
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Project Management </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            @permission('projects.listing')
                            <li class="sidebar-item {{ Request::is('pms/projects') ? 'selected' : '' }}"><a href="{{url('/pms/projects')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> View All Projects </span></a></li>
                            @endpermission
                            @permission('cr.listing')
                            <li class="sidebar-item {{ Request::is('pms/cr/all_cr') ? 'selected' : '' }}"><a href="{{url('/pms/cr/all_cr')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> View All CR </span></a></li>
                            @endpermission
                            <li class="sidebar-item {{ Request::is('pms/projects/myprojects') ? 'selected' : '' }}"><a href="{{url('/pms/projects/myprojects')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> My Projects </span></a></li>
                            <li class="sidebar-item {{ Request::is('pms/tasks/mytasks') ? 'selected' : '' }}"><a href="{{url('/pms/tasks/mytasks')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> My Tasks </span></a></li>
                            @role('pm|tl')
                            <?php
                            /*
                            <li class="sidebar-item {{ Request::is('pms/projects/teamprojects') ? 'selected' : '' }}"><a href="{{url('/pms/projects/teamprojects')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Team Projects </span></a></li>
                            */ ?>
                            <li class="sidebar-item {{ Request::is('pms/tasks/myteam') ? 'selected' : '' }}"><a href="{{url('/pms/tasks/myteam')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> My Team </span></a></li>
                            <li class="sidebar-item {{ Request::is('pms/tasks/teamtasks') ? 'selected' : '' }}"><a href="{{url('/pms/tasks/teamtasks')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Team Tasks </span></a></li>
                            @endrole
                        </ul>
                    </li>
                @endrole
                @role('pm|tl')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Reports </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            @permission('teamtaskentry.listing')
                                <li class="sidebar-item {{ Request::is('pms/teamtasksentries') ? 'selected' : '' }}"><a href="{{url('/pms/teamtasksentries')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Team Task Entries </span></a></li>
                            @endpermission
                        </ul>
                    </li>
                @endrole
                @permission('pms.uploadsalaryslip|pms.uploadtimeentry')
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">PMS Management </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        @permission('pms.uploadsalaryslip')
                        <li class="sidebar-item {{ Request::is('pms/uploadcsv') ? 'selected' : '' }}"><a href="{{url('/pms/uploadcsv')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Upload Salary CSV </span></a></li>
                        @endpermission
                        @permission('pms.uploadtimeentry')
                        <li class="sidebar-item {{ Request::is('pms/uploadpms') ? 'selected' : '' }}"><a href="{{url('/pms/uploadpms')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Upload PMS CSV </span></a></li>
                        @endpermission
                        <li class="sidebar-item {{ Request::is('pms/holidays') ? 'selected' : '' }}"><a href="{{url('/pms/holidays')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Public Holidays </span></a></li>
                    </ul>
                </li>
                @endpermission
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">General</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item {{ Request::is('pms/leaverequests') ? 'selected' : '' }}"><a href="{{url('/pms/leaverequests')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Leave Requests </span></a></li>
                        <li class="sidebar-item {{ Request::is('pms/compoffrequests') ? 'selected' : '' }}"><a href="{{url('/pms/compoffrequests')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Comp-off Requests </span></a></li>
                        @role('pm|tl|admin')
                        <li class="sidebar-item {{ Request::is('pms/teamleaves') ? 'selected' : '' }}"><a href="{{url('/pms/teamleaves')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Team Leave Requests </span></a></li>
                        <li class="sidebar-item {{ Request::is('pms/teamcompoffs') ? 'selected' : '' }}"><a href="{{url('/pms/teamcompoffs')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Team Comp-off Requests </span></a></li>
                        @endrole
                        @role('hr|admin')
                        <li class="sidebar-item {{ Request::is('pms/teamcompoffs') ? 'selected' : '' }}"><a href="{{url('/pms/teamcompoffs')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Employee Comp-off Requests </span></a></li>
                        @endrole
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<?php
/*
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
  <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
  <li class="{{ Request::is('admin/users') ? 'active' : '' }}"> <a href="{{url('/admin/users')}}"><i class="icon icon-user"></i> <span>User Management</span></a> </li>
  <li class="{{ Request::is('admin/projects') ? 'active' : '' }}"> <a href="{{url('/admin/projects')}}"><i class="icon icon-user"></i> <span>Project Management</span></a> </li>
  <li class="{{ Request::is('admin/users/roles') ? 'active' : '' }}"> <a href="{{url('/admin/users/roles')}}"><i class="icon icon-user"></i> <span>Role Management</span></a> </li>
  <li class="submenu"> 
  	<a href="javascript:void(0)"><i class="icon icon-info-sign"></i> <span>PMS Management</span> </a>
      <ul>
        <li class="{{ Request::is('admin/uploadcsv') ? 'active' : '' }}"> <a href="{{url('/admin/uploadcsv')}}"><i class="icon icon-file"></i> <span>Upload Salary CSV</span></a> </li>
		<li class="{{ Request::is('admin/uploadpms') ? 'active' : '' }}"> <a href="{{url('/admin/uploadpms')}}"><i class="icon icon-file"></i> <span>Upload PMS CSV</span></a> </li>
		<li class="{{ Request::is('admin/requesttimesheet') || Request::is('admin/viewtimesheet') ? 'active' : '' }}"> <a href="{{url('/admin/requesttimesheet')}}"><i class="icon icon-th-list"></i> <span>View Time Sheet</span></a> </li>
      </ul>
    </li>  
  <li class="{{ Request::is('admin/settings') ? 'active' : '' }}"> <a href="{{url('/admin/settings')}}"><i class="icon icon-key"></i> <span>Password Settings</span></a> </li>
  </ul>
</div>
<!--sidebar-menu-->
*/
?>