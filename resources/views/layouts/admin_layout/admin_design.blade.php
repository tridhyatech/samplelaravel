<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Admin Panel</title>
    <!-- Custom CSS -->
    <link href="{{asset('css/admin_css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin_css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin_css/float-chart.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin_css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin_css/custom-style.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('js/admin_js/jquery.min.js')}}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('js/admin_js/popper.min.js')}}"></script>
    <script src="{{asset('js/admin_js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/admin_js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('js/admin_js/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/admin_js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/admin_js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/admin_js/custom.min.js')}}"></script>
    <script src="{{asset('js/admin_js/select2.full.min.js')}}"></script>
    <script src="{{asset('js/admin_js/select2.min.js')}}"></script>
    <script src="{{asset('js/admin_js/bootstrap-datepicker.min.js')}}"></script>
</head>
<body>
@include('layouts.admin_layout.admin_header')
@include('layouts.admin_layout.admin_sidebar')
@yield('content')
@include('layouts.admin_layout.admin_footer')
<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
