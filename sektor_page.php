<?php
include 's/config.php';

$qry = "SELECT *FROM tbl_sektor";
$res = mysqli_query($conn, $qry);
// var_dump($row);die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Area</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="node_modules/prismjs/themes/prism.css">
<link rel="stylesheet" href="node_modules/izitoast/dist/css/iziToast.min.css">
<link rel="stylesheet" href="assets/main.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
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

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
              <h1>Area</h1>
          </div>
          <div class="section-body">
              <!-- <a href="#" id="openAddMinistry" class="btn btn-icon icon-left btn-primary mb-3" onclick="showAddMinistry()">
                  <i class="fas fa-plus-circle"></i>
                  New</a> -->
              <!-- <div class="card" >
                  <div class="card-body">
                      <div class="empty-state" data-height="250">
                          <img src="assets/img/ph-black.png" alt="" style="width: 250px;">
                          <h2>We couldn't find any data</h2>
                      </div>
                  </div>
              </div> -->
              <div class="row ministry-container">
                <?php
                while($row = mysqli_fetch_array($res)) {
                 ?> 
              <div class="col-lg-6">
                  <div class="card card-large-icons position-relative">
                    <div class="card-body position-relative">
                      <i class="fas fa-bars position-absolute" style="top: 10px; right: 10px; cursor: pointer;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" href="#"  data-edit="true" onclick="showAddMinistry()">Edit</a>
                        <a class="dropdown-item delete-ministry" href="#" onclick="confirmDelete()">Delete</a>
                      </div>
                      <h3 id="ministryCard">
                        <a href="sektor_keluarga.php?ids=<?= $row['inisial_sektor'] ?>">
                          <?= $row['nama_sektor'] ?>     
                        </a> 
                        </h3>
                    </div>
                  </div>
                </div>
                <?php }?>
              </div>
          </div>
          </div>
          <!-- Modal Ministry -->
          <div class="modal fade" id="ministryModal" tabindex="-1" role="dialog" aria-labelledby="ministryModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header pb-3 pt-3" style="background-color: #06548A; color: white;">
                          <h5 class="modal-title" id="ministryModalLabel">Input Area</h5>
                      </div>
                      <div class="modal-body">
                          <form action="#" id="ministryForm" method="POST"
                              enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="title">Kode Area <span class="text-danger">*</span></label>
                                <input type="text" class="form-control validate"
                                    placeholder="Kode Area">
                            </div>
                              <div class="form-group">
                                  <label for="title">Nama Area <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control validate" 
                                      placeholder="Nama Area">
                              </div>
                              <div class="form-group">
                                  <label for="description">Alamat Area <span class="text-danger">*</span></label>
                                  <textarea class="form-control validate" placeholder="Alamat Area" style="height: 100px;"></textarea>
                              </div>
                              <div class="form-group">
                                <label for="description">Catatan <span class="text-danger">*</span></label>
                                <textarea class="form-control validate" placeholder="Catatan" style="height: 50px;"></textarea>
                            </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                          <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                          </form>
                      </div>
                  </div>
              </div>
            </div>
      </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2024 <div class="bullet"></div> GPIB Pelita Hidup 
        </div>
        <div class="footer-right">
          1.0.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="node_modules/prismjs/prism.js"></script>
<script src="node_modules/izitoast/dist/js/iziToast.min.js"></script>
<script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function showAddMinistry() {
      $('#ministryModal').modal('show');
      $('#act').val('add');
    }
    function showToastr(type, message) {
        iziToast[type]({
            title: 'Success',
            message: message,
            position: 'topRight',
            timeout: 3000,
        });
    }

    document.getElementById('btnSave').addEventListener('click', function() {
      event.preventDefault();
      $('#ministryModal').modal('hide');
      showToastr('success', "Sukses menyimpan area Gedung Gereja");
    });
    
    function confirmDelete() {
            swal({
                title: 'Apakah anda yakin menghapus Gedung Gereja? ?',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: 'Cancel',
                        visible: true,
                    },
                    confirm: {
                        text: 'Delete',
                    },
                },
                dangerMode: true,
            }).then((result) => {
                if (result) {
                  showToastr('success', "Sukses menghapus area Gedung Gereja");
                }
            });
        }
</script>
</body>

</html>