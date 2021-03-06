<!DOCTYPE html>
  <html lang="{{ app()->getLocale() }}">
    <head>
      <?php $title='PTC-Official'?>
      @include('includes.metadata')
      
    </head>

    <body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>



  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="/../img/logo_ptc.png" alt="PTC Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PTC - Official</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/../img/student.svg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">
          @if ((Auth::user()->usertype) !== 'superadmin')
          {{Auth::user()->email}}
          @else
          {{Auth::user()->email}}
          @endif
        </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @include('includes.sidebarmenu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <router-view></router-view>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('includes.footer')
<!-- ./wrapper -->

{{-- @auth
<script>
  window.user = {!! json_encode([
        'id_num'=>auth()->user()->id_num,
        'usertype'=> auth()->user()->usertype,
    ]) !!};
</script>   
@endauth --}}

@include('includes.js')

<script src="/js/app.js"></script>


</body>
</html>
