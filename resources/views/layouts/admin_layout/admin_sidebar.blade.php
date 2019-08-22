<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item {{ Request::is('admin/dashboard') ? 'selected' : '' }}"> 
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/users') ? 'selected' : '' }}"> 
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/users')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">User Management</span></a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/projects') ? 'selected' : '' }}"> 
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/projects')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Project Management</span></a>
                </li>
                @permission('designation.listing')
                <li class="sidebar-item {{ Request::is('admin/designation') ? 'selected' : '' }}"> 
                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/designation')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Designation Management</span></a>
                </li>
                @endpermission
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">PMS Management </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item {{ Request::is('admin/uploadcsv') ? 'selected' : '' }}"><a href="{{url('/admin/uploadcsv')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Upload Salary CSV </span></a></li>
                        <li class="sidebar-item {{ Request::is('admin/uploadpms') ? 'selected' : '' }}"><a href="{{url('/admin/uploadpms')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Upload PMS CSV </span></a></li>
                        <li class="sidebar-item {{ Request::is('admin/viewtimesheet') ? 'selected' : '' }}"><a href="{{url('/admin/viewtimesheet')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> View Time Sheet </span></a></li>
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
  <li class="{{ Request::is('admin/roles') ? 'active' : '' }}"> <a href="{{url('/admin/roles')}}"><i class="icon icon-user"></i> <span>Role Management</span></a> </li>
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