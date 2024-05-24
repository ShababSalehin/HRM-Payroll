<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR Payroll| Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ static_asset('assets/plugins/fontawesome-free/css/all.min.css') }}" >
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ static_asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" >
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ static_asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" >
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ static_asset('assets/plugins/jqvmap/jqvmap.min.css') }}" >
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ static_asset('assets/dist/css/adminlte.min.css') }}" >
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ static_asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" >
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ static_asset('assets/plugins/daterangepicker/daterangepicker.css') }}" >
  <!-- summernote -->
  <link rel="stylesheet" href="{{ static_asset('assets/plugins/summernote/summernote-bs4.min.css') }}" >

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  

<!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ static_asset('assets') }}/dist/css/adminlte.min.css">





</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ static_asset('assets/dist/img/AdminLTELogo.png') }}"  alt="AdminLTELogo" height="60" width="60">
  </div>

  

@include('inc.navbar')


@include('inc.sidebar')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

      @yield('content_header')
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @yield('main_content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  @include('inc.footer')

  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ static_asset('assets/plugins/jquery/jquery.min.js') }}" ></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ static_asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" ></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ static_asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
<!-- ChartJS -->
<script src="{{ static_asset('assets/plugins/chart.js/Chart.min.js') }}" ></script>
<!-- Sparkline -->
<script src="{{ static_asset('assets/plugins/sparklines/sparkline.js') }}" ></script>
<!-- JQVMap -->
<script src="{{ static_asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}" ></script>
<script src="{{ static_asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}" ></script>
<!-- jQuery Knob Chart -->
<script src="{{ static_asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}" src=""></script>
<!-- daterangepicker -->
<script src="{{ static_asset('assets/plugins/moment/moment.min.js') }}" ></script>
<script src="{{ static_asset('assets/plugins/daterangepicker/daterangepicker.js') }}" ></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ static_asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}" ></script>
<!-- Summernote -->
<script src="{{ static_asset('assets/plugins/summernote/summernote-bs4.min.js') }}" ></script>
<!-- overlayScrollbars -->
<script src="{{ static_asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}" ></script>
<!-- AdminLTE App -->
<script src="{{ static_asset('assets/dist/js/adminlte.js') }}" ></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ static_asset('assets/dist/js/demo.js') }}" ></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ static_asset('assets/dist/js/pages/dashboard.js') }}" ></script>


<!-- DataTables  & Plugins -->
<script src="{{ static_asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ static_asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



<!-- bootstrap color picker -->
<script src="{{ static_asset('assets') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ static_asset('assets') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="{{ static_asset('assets') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="{{ static_asset('assets') }}/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="{{ static_asset('assets') }}/plugins/dropzone/min/dropzone.min.js"></script>



</body>
</html>
