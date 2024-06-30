<?php
include 'koneksi.php';

if(!empty($_POST)) {
  $sql = "SELECT COUNT(*) as total FROM tbl_sektor";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total = $row["total"];

    if($total < 5) {
      foreach ($_POST as $k => $v) {
      $$k = $v;
      
    }
      
      $created_date = date('Y-m-d H:i:S');
      $qry = "INSERT INTO tbl_sektor (kd_sektor, inisial_sektor, nama_sektor, deskripsi, created_at) VALUES ('', '$inisial_sektor', '$nama_sektor', '$deskripsi_sektor', '$created_date')";
      
      $ret = mysqli_query($conn, $qry);

        if($ret){
          $stat ='success';
          $msg = 'Sektor '. $nama_sektor. 'berhasil ditambahkan'; 
        }
    }
    else{
      $stat = 'error';
      $msg = 'Sektor sudah melebihi batas input';
    }
  }
}

if (isset($_GET['type']) && isset($_GET['id'])) {
  $id = $_GET['id'];

  $qryGet = "SELECT * FROM tbl_sektor WHERE kd_sektor = '$id'";
  $result = mysqli_query($conn, $qryGet);

  if ($result) {
      $data = mysqli_fetch_assoc($result);
      if ($data) {
          echo json_encode($data);
      } else {
          echo json_encode(['content' => 'No data found']);
      }
  } else {
      echo json_encode(['content' => 'Error executing query']);
  }
  exit;
}  

if (isset($_GET['ngentod']) && $_GET['ngentod'] == 'hapus' && isset($_GET['id'])) {

  $id = $_GET['id'];

  $qryDelete = "DELETE FROM tbl_sektor WHERE kd_sektor = '$id'";

  if (mysqli_query($conn, $qryDelete)) {
      echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus data']);
  }
  exit;
}

$qry = "SELECT * FROM tbl_sektor";
$res = mysqli_query($conn, $qry);
// var_dump($res);

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
            <div class="section-header-back">
              <button class="btn btn-icon trigger--fire-modal-2" data-toggle="modal" data-target="#modal1" onclick="history.back()"><i class="fas fa-arrow-left"></i></button>
            </div>
              <h1>SEKTOR</h1>
          </div>
          <div class="section-body">
            <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
              <div class="card mb-1">
                <div class="card-header">
                  <h4>Input Sektor</h4>
                </div>
                <div class="card-body pt-1">
                  <form action="" method="POST">
                  <div class="form-group mb-0">
                    <label>Inisial sektor</label>
                    <input type="text" class="form-control" placeholder="Inisial Sektor" name="inisial_sektor" id="inisialSektor" maxlengTH="3">
                  </div>
                  <div class="form-group mb-0">
                    <label>Nama Sektor</label>
                    <input type="text" class="form-control" placeholder="Nama Sektor"name="nama_sektor" id="namaSektor">
                  </div>
                  <div class="form-group mb-0">
                    <label>Deskripsi</label>
                  <textarea class="form-control validate" placeholder="Deskripsi" style="height: 50px;" name="deskripsi_sektor" id="deskripsiSektor"></textarea>
                  </div>
                  <div class="form-group mb-1">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary float-md-right" >Save</button>
                      <button type="submit" class="btn btn-warning float-md-right mr-1" id="btnReset" onclick="resetUpdate()">Reset</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Data Sektor</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <div id="table-2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                      <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="table-2"
                                            aria-label="Task Name: activate to sort column ascending" style="width: 20px;">
                                            Kode Sektor
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="table-2" 
                                            aria-label="Due Date: activate to sort column ascending" style="width: 20px;">
                                            Nama Sektor
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="table-2"
                                            aria-label="Status: activate to sort column ascending" style="width: 30px;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    while($row = mysqli_fetch_array($res)) {
                                     ?> 
                                   <tr role="row" class="odd">
                                        <td><a href="#" class="btn-show" data-id='<?= $row["kd_sektor"] ?>'><?= $row['inisial_sektor']?></a></td>
                                        <td><?= $row['nama_sektor']?></td>
                                        <td>
                                            <a href="#" class="btn btn-secondary btn-sm btn-edit" data-id='<?= $row["kd_sektor"] ?>'><i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="deleteData(<?= $row['kd_sektor'] ?>)" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                  <?php }?>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-5">
                          <div class="dataTables_info" id="table-2_info" role="status" aria-live="polite">Showing 1 to
                            4 of 4 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                          <div class="dataTables_paginate paging_simple_numbers" id="table-2_paginate">
                            <ul class="pagination">
                              <li class="paginate_button page-item previous disabled" id="table-2_previous"><a
                                  href="#" aria-controls="table-2" data-dt-idx="0" tabindex="0"
                                  class="page-link">Previous</a></li>
                              <li class="paginate_button page-item active"><a href="#" aria-controls="table-2"
                                  data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                              <li class="paginate_button page-item next disabled" id="table-2_next"><a href="#"
                                  aria-controls="table-2" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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

    let msg = '<?= isset($msg) ? $msg : '' ?>';
    let stat = '<?= isset($stat) ? $stat : '' ?>';

    function showAddMinistry() {
      $('#ministryModal').modal('show');
      $('#act').val('add');
    }
    function showToastr(type, message) {
        iziToast[type]({ 
            title: type,
            message: message,
            position: 'topRight',
            timeout: 3000,
        });
    }

      $(document).ready(function(){
        $('#btnReset').addClass('d-none');
        $('.btn-edit').click(function(event) {
            event.preventDefault();
            var type = 'edit';
            let id = $(this).data('id');
            getData(id, type);
        });
        $('.btn-show').click(function(event) {
            event.preventDefault();
            var type = 'show';
            let id = $(this).data('id');
            getData(id, type);
        });
        if(msg){
          showToastr(stat, msg);
        } 
      });

      function resetUpdate(){
        event.preventDefault();
        $('#inisialSektor').val('');
        $('#namaSektor').val('');
        $('#deskripsiSektor').val('');
        $('#btnReset').addClass('d-none');
      }


      function getData(id, type) {
            $.ajax({
                url: 'sektor.php',
                type: 'GET',
                data: { 
                  id: id,
                  type: type,
                 },
                success: function(response) {
                    data = JSON.parse(response);

                    if(type == 'edit'){
                      $('#inisialSektor').val(data.inisial_sektor).prop('disabled', false);
                      $('#namaSektor').val(data.nama_sektor).prop('disabled', false);
                      $('#deskripsiSektor').val(data.deskripsi).prop('disabled', false);
                      $('#btnReset').removeClass('d-none');
                    }else if(type == 'show'){
                      $('#inisialSektor').val(data.inisial_sektor).prop('disabled', true);
                      $('#namaSektor').val(data.nama_sektor).prop('disabled', true);
                      $('#deskripsiSektor').val(data.deskripsi).prop('disabled', true);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function deleteData(id) {
            $.ajax({
                url: 'sektor.php',
                type: 'GET',
                data: { 
                  ngentod: 'hapus',
                  id: id
                 },
                success: function(response) {
                  console.log(response);
                  location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

    // document.getElementById('btnSave').addEventListener('click', function() {
    //   event.preventDefault();
    //   $('#ministryModal').modal('hide');
    //   showToastr('success', "Sukses menyimpan Aset Bergerak");
    //   // console.log('TEST');
    // });
</script>
</body>

</html>