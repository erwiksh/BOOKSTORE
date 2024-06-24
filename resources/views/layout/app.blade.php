<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UNIBOOKSTORE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/search.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap">


  <!-- Custom CSS untuk warna navbar -->
  <style>
    .navbar-purple {
      background-color: white !important; /* Ubah warna background menjadi ungu */
      background: linear-gradient(135deg, #C76CD7 0%, #3324AFAD 100%); /* Gradien linear sebagai latar belakang */
      color: white !important; /* Ubah warna teks menjadi putih */
      border-radius: 10px; /* Tambahkan border-radius */
      margin: 50px; /* Tambahkan margin */
      margin-bottom: 0; /* Hapus margin bottom */
      padding: 20px; /* Tambahkan padding */
    }
    .navbar-purple .nav-link {
      color: white !important; /* Ubah warna teks menjadi putih */
      font-family: 'Montserrat', sans-serif;
      font-size: 15px;
    }

    .navbar-purple .nav-link:hover {
      color: red !important; /* Ubah warna teks link menjadi merah saat hover */
      transition: color 0.3s ease; /* Tambahkan animasi transisi */
    } 
    .navbar-purple .dropdown-menu .dropdown-item:hover {
      color: red; /* Ubah warna background item dropdown saat hover */
      transition: color 0.3s ease; /* Tambahkan animasi transisi */
    }
  </style>
</head>
<body>
<div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-white navbar-light navbar-purple">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/admin" id="navbarDropdownAdmin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                <a class="dropdown-item" href="{{ route ('buku.admin') }}">Buku</a>
                <a class="dropdown-item" href="{{ route ('penerbit.admin') }}">Penerbit</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="/pengadaan" class="nav-link">Pengadaan Buku</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            @yield('cari')
        </li>
    </ul>
  </nav>

  <!-- Content Wrapper. Contains page content -->
  <div class="content" style="margin: 20px; padding: 20px; margin-top: 0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('nama halaman')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="https://chlorinedigitalmedia.com/">
                  <img src="{{ asset('image/Logo Chlorine text samping.png') }}" alt="Logo Chlorine White" style="max-width: 6.5em; max-height: 6.5em;">
                </a>
              </li>
              <li class="breadcrumb-item">
                <a href="https://smkn1tanjungpandan.sch.id/">
                  <img src="{{ asset('image/logo Smk.png') }}" alt="Logo SMKN 1 Tanjungpandan" style="max-width: 1.7em; max-height: 1.7em;">
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
