<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: {$base_url}login.php");// Redirect ke halaman login jika belum login
    exit();
}

include 's/config.php';
include 'partials/header.php';
?>
<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-church"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sektor</h4>
                  </div>
                  <div class="card-body">
                    <?= $sek['sektor']?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-home"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>KK</h4>
                  </div>
                  <div class="card-body">
                  <?= $kel['keluarga']?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jemaat</h4>
                  </div>
                  <div class="card-body">
                    <?= $ang['jemaat']?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
            </div>
          </div>
        </section>
      </div>
      <?php include 'partials/footer.php';?>