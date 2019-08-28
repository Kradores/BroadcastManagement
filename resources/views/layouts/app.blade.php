<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Broadcast Management</title>

  <link rel="stylesheet" href="{{asset('css/all.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('inc.top-navbar')

@include('inc.left-sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('header')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
              <li class="breadcrumb-item active">@yield('header')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @include('inc.messages')
            @yield('content')
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('inc.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{asset('js/all.js')}}"></script>
<script language="javascript">
    var clock = 0;
    var interval_msec = 1000;
    var AftTimeZone = 270; // minutes

    // ready
    $(function() {
        // set timer
        clock = setTimeout("UpdateClock()", interval_msec);
    });

    // UpdateClock
    function UpdateClock(){

        // clear timer
        clearTimeout(clock);

        var dt_now = new Date();
        var hh	= dt_now.getHours();
        var mm	= dt_now.getMinutes() + dt_now.getTimezoneOffset() + AftTimeZone;
        var ss	= dt_now.getSeconds();

        if(mm > 60){
            hh = hh + parseInt(mm/60);
            mm = mm - parseInt(mm/60)*60;
        }
        if(hh > 23) {
            hh = hh - 24;
        }
        if(hh < 10){
            hh = "0" + hh;
        }
        if(mm < 10){
            mm = "0" + mm;
        }
        if(ss < 10){
            ss = "0" + ss;
        }
        $(".myclock").html( hh + ":" + mm + ":" + ss);

        // set timer
        clock = setTimeout("UpdateClock()", interval_msec);

    }
</script>
</body>
</html>
