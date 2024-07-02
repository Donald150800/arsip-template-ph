<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <!-- <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li> -->
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown"
        class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="d-sm-none d-lg-inline-block">Hi, $session->username</div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">Logged in 5 min ago</div>
        <!-- <a href="features-profile.html" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <a href="features-activities.html" class="dropdown-item has-icon">
          <i class="fas fa-bolt"></i> Activities
        </a>
        <a href="features-settings.html" class="dropdown-item has-icon">
          <i class="fas fa-cog"></i> Settings
        </a> -->
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="assets/img/ph-black.png" alt="" style="width: 135px; margin-top: 10px;">
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="index.html"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <li class="menu-header">Master Data</li>
      <li><a class="nav-link" href="area.html"><i class="fas fa-building"></i> <span>Area</span></a></li>
      <li><a class="nav-link" href="barang.html"><i class="fas fa-archive"></i> <span>Barang</span></a></li>
      <li class="menu-header">Setting</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
          <span>Settings</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="aset.html"><span>Aset</span></a></li>
          <li><a class="nav-link" href="jenis.html"><span>Jenis</span></a></li>
          <li><a class="nav-link" href="unit.html"><span>Unit</span></a></li>
        </ul>
      </li>
    </ul>
    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Documentation
      </a>
    </div>
  </aside>
</div>