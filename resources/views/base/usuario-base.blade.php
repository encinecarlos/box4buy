<!DOCTYPE html>
<html>
<head>
  <html lang="pt-br">
  <meta charset="utf8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Box4Buy - Area do Cliente</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->  
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css') }}">
  {{-- JQuery modal --}}
  <link rel="stylesheet" href="{{ asset('bower_components/jquery-modal/jquery.modal.css') }}">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> --}}
  <!-- toastrjs CSS -->
  <link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.css') }}">  
  <link rel="stylesheet" href="{{ asset('bower_components/sweetalert2/dist/sweetalert2.min.css') }}">
  @yield('css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue fixed">
<!-- Site wrapper -->
<div class="wrapper">

  @include('base.usuario-header')

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  @include('base.usuario-sidebar')

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">      
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      @version('full')
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://devhousesolutions.com.br" target="_blank">DevHouse Solutions</a>.</strong> All rights
    reserved.
  </footer> 
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }} "></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('bower_components/admin-lte/dist/js/demo.js') }} "></script> --}}
<!-- toastrjs -->
<script src="{{ asset('bower_components/toastr/toastr.js') }}"></script>
{{-- JQuery Modal --}}
<script src="{{ asset('bower_components/jquery-modal/jquery.modal.js') }}"></script>
{{-- InputMask --}}
<script src="{{ asset('bower_components/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('bower_components/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
@yield('js')
<!-- Arquivo js customozado da aplicação -->
<script src="{{ asset('js/main.js') }}"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>

</body>
</html>
