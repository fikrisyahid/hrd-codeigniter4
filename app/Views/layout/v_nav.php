<!-- Sidebar -->
<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>/template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- Data pegawai start -->
          <li class="nav-item">
            <a href="<?= base_url('home/datapegawai') ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Data Pegawai</p>
            </a>
          </li>
          <!-- Data Pegawai end -->

          <!-- Absensi start -->
          <li class="nav-item">
            <a href="<?= base_url('home/absensi') ?>" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Absensi</p>
            </a>
          </li>
          <!-- Absensi end -->

          <!-- Gaji start -->
          <li class="nav-item">
            <a href="<?= base_url('home/gaji') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>Gaji</p>
            </a>
          </li>
          <!-- Gaji end -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Beranda</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- v_home -->
        