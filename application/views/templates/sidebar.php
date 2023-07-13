<?php
if ($login['role_id'] == 1) : ?>
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark shadow-lg accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="<?= base_url('assets/sample/posyandumawar-logo.png') ?>" alt="Logo Posyandu Mawar" class="img-fluid" width="40px">
      </div>
      <!-- <div class="sidebar-brand-text mx-3">P. Mawar </div> -->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $title === 'Dashboard' ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('admin') ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Data
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $title == 'Data Balita' || $title == 'Tambah Balita' || $title == 'Ubah Data Balita' ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('balita') ?>">
        <i class="fas fa-fw fa-baby"></i>
        <span>Data Balita</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $title == 'Dataset' || $title == 'Tambah Dataset' ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('dataset') ?>">
        <i class="fas fa-fw fa-archive"></i>
        <span>Dataset</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      KNN
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $title == 'Ukur Balita' || $title == 'Tambah Data Ukur Balita' || $title == 'Detail Ukur Balita' || $title == 'Ubah Ukur Balita' ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('knn') ?>">
        <i class="fas fa-fw fa-weight"></i>
        <span>Ukur Balita</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('auth/logout') ?>">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Keluar</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


  </ul>
  <!-- End of Sidebar -->
<?php else : ?>
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark shadow-lg accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="<?= base_url('assets/sample/posyandumawar-logo.png') ?>" alt="Logo Posyandu Mawar" class="img-fluid" width="40px">
      </div>
      <!-- <div class="sidebar-brand-text mx-3">P. Mawar </div> -->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $title === 'Info Balita' ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('user') ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Info Balita</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('auth/logout') ?>">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Keluar</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


  </ul>
  <!-- End of Sidebar -->
<?php endif ?>