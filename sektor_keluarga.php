<?php
include "koneksi.php";

$inisial_sektor = $_GET['ids'];
$qry = "SELECT * FROM tbl_sektor WHERE inisial_sektor = '$inisial_sektor'";
$res = mysqli_query($conn, $qry);
$row = mysqli_fetch_assoc($res);
$nama_sektor = $row['nama_sektor'];
$kd_sektor = $row['kd_sektor'];

$qry_kel = "SELECT COUNT(*) as total FROM tbl_keluarga WHERE kd_sektor = $kd_sektor ORDER BY kd_keluarga DESC LIMIT 1";
// echo $qry_kel;
$res = mysqli_query($conn, $qry_kel);

// Mengambil hasil query
$last_id_kel = 0;
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $last_id_kel = intval($row['total']);
}

$next_id = $last_id_kel + 1;
$kode_keluarga = $inisial_sektor . str_pad($next_id, 3, '0', STR_PAD_LEFT);

if(!empty($_POST)){

    $nama_keluarga = $_POST['nama_keluarga'];
    $kd_ref_keluarga = $_POST['kd_ref_keluarga'];
    $alamat_keluarga = $_POST['alamat_keluarga'];
    $created_date = date('Y-m-d H:i:S');

    $qry = "INSERT INTO tbl_keluarga (kd_keluarga, kd_ref_keluarga, nama_keluarga, alamat_keluarga, kd_sektor, created_at) VALUES ('', '$kd_ref_keluarga', '$nama_keluarga', '$alamat_keluarga', $kd_sektor, '$created_date')";      
    $ret = mysqli_query($conn, $qry);
    $kd_keluarga_last = mysqli_insert_id($conn);

    $nama_anggota = $_POST['nama_anggota'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status_hubungan = $_POST['status_hubungan'];


     for ($i = 0; $i < count($nama_anggota); $i++) {
         $nama = $nama_anggota[$i];
         $kelamin = $jenis_kelamin[$i];
         $status = $status_hubungan[$i];
         $kueri = "INSERT INTO tbl_anggota_keluarga (kd_keluarga, nama_anggota, jenis_kelamin, status_hubungan, created_at, updated_at) VALUES ($kd_keluarga_last, '$nama', '$kelamin', '$status', '$created_date', null)";
         // echo $kueri.'<br>'; die();
         $ret = mysqli_query($conn, $kueri);
     }

    if($ret){
        $stat ='success';
        $msg = 'Keluarga'. $nama_keluarga . 'berhasil ditambahkan'; 
    }else{
        echo 'GAGAL';die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Data Sektor - <?= $nama_sektor?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
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
              <h1>Data Keluarga - Sektor <?= $nama_sektor ?></h1>
          </div>
          <div class="section-body">
            <a href="#" id="openAddMinistry" class="btn btn-icon icon-left btn-primary mb-3" onclick="showAddBarang()"><i class="fas fa-plus-circle"></i> New</a>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">    
                                            <label>Status:</label> 
                                            <select name="table-2_length" aria-controls="table-2" class="form-control form-control-sm selectric">
                                                <option value="" selected disabled>Filter Data by Status</option>
                                                <option value="">Aktif</option>
                                                <option value="">Hilang</option>
                                                <option value="">Rusak</option>
                                                <option value="">Terjual</option>
                                                <option value="">No Filter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 px-0">
                                        <div class="form-group">
                                            <label>Date :</label>
                                            <div class="row">
                                                <div class="col-5 pr-0">
                                                    <input type="date" class="form-control">
                                                </div>
                                                <div class="col-5 pr-0">
                                                    <input type="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 pr-0"><label>Search:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-append">
                                              <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 text-center pl-0" style="margin-top: 33px;">
                                        <button class="btn btn-success">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                    </div>
                                </div>
                                <table class="table table-striped mt-1" id="table-2">
                                  <thead>
                                    <tr>
                                      <th class="text-center"> Kode</th>
                                      <th>Nama Barang</th>
                                      <th>Jumlah</th>
                                      <th>Ruang</th>
                                      <th>Created Date</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td class="text-center"><a href="#" onclick="detailBarang()">GSG-R1-FN-002</a></td>
                                      <td>Meja</td>
                                      <td class="align-middle">50 Unit</td>
                                      <td>Ruang 1 (GSG)</td>
                                      <td>20/01/2024</td>
                                      <td><div class="badge badge-success">Aktif</div></td>
                                      <td>
                                        <a href="#" class="btn btn-secondary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><a href="#">GSG-R1-FN-003</a></td>
                                        <td>Projector</td>
                                        <td class="align-middle">1 Unit</td>
                                        <td>Ruang 1 (GSG)</td>
                                        <td>20/01/2024</td>
                                        <td><div class="badge badge-success">Aktif</div></td>
                                        <td>
                                          <a href="#" class="btn btn-secondary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                          <a href="#" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
                                         </td>
                                      </tr>
                                      <tr>
                                        <td class="text-center"><a href="#">GSG-R1-FN-004</a></td>
                                        <td>Laptop</td>
                                        <td class="align-middle">1 Unit</td>
                                        <td>Kantor (GSG)</td>
                                        <td>20/01/2024</td>
                                        <td><div class="badge badge-danger">Hilang</div></td>
                                        <td>
                                          <a href="#" class="btn btn-secondary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                          <a href="#" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
                                         </td>
                                      </tr>
                                      <tr>
                                        <td class="text-center"><a href="#">PST-RT-FN-001</a></td>
                                        <td>TV</td>
                                        <td class="align-middle">1 Unit</td>
                                        <td>R. Tamu (PST)</td>
                                        <td>20/01/2024</td>
                                        <td><div class="badge badge-warning">Rusak</div></td>
                                        <td>
                                          <a href="#" class="btn btn-secondary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                          <a href="#" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
                                         </td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                  <div class="dataTables_info" id="table-2_info" role="status" aria-live="polite">Showing 1 to
                                    4 of 4 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-5">
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
                                <div class="col-sm-12 col-md-2">
                                    <div class="dataTables_length" id="table-2_length"><select name="table-2_length"
                                          aria-controls="table-2" class="form-control form-control-sm">
                                          <option value="10">10</option>
                                          <option value="25">25</option>
                                          <option value="50">50</option>
                                          <option value="100">100</option>
                                        </select>
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
          </div>
      </section>
      <!-- Modal Ministry -->
      <div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="ministryModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header pb-3 pt-3" style="background-color: #06548A; color: white;">
                  <h5 class="modal-title" id="barangLabel">Input Inventaris</h5>
              </div>
              <div class="modal-body pb-0">
                  <form action="#" id="ministryForm" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-12">
                          <div class="card mb-1">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label>Kode Keluarga </label>
                                                    <input type="text" class="form-control" name="kd_ref_keluarga" value="<?= $kode_keluarga?>" id="kd_ref_keluarga" readonly="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label>Nama Keluarga </label>
                                                    <input type="text" class="form-control" name="nama_keluarga" placeholder="Nama Keluarga" id="kd_ref_keluarga">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label>Alamat Rumah :</label>
                                                    <textarea class="form-control validate" name="alamat_keluarga" placeholder="Alamat Rumah" style="height: 145px;" id="catatan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <div class="form-group mb-2">
                                            <div class="form-check">
                                                <button id="tambahAnak" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="anakContainer">
                                <div class="row anak">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Anggota Keluarga<span class="text-danger">*</span> :</label>
                                                    <input type="text" class="form-control" name="nama_anggota[]" placeholder="Anggota Keluarga" id="anggota_keluarga">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin<span class="text-danger">*</span> :</label>
                                                    <select class="form-control selectric" name="jenis_kelamin[]" id="jkPasangan">
                                                        <option selected="" disabled>Jenis Kelamin</option>
                                                        <option value="P">Pria</option>
                                                        <option value="W">Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Status<span class="text-danger">*</span> :</label>
                                                    <select class="form-control selectric" name="status_hubungan[]" id="statPasangan">
                                                        <option selected="" disabled>Status Hubungan</option>
                                                        <option value="Ayah">Ayah</option>
                                                        <option value="Ibu">Ibu</option>
                                                        <option value="Anak">Anak</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-0">
                                            <button class="btn btn-danger deleteAnak">-</button>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                          </div>
                        </div>
                        </div>
              </div>
              <div class="modal-footer pt-3">
                  <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                  <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                </form>
              </div>
          </div>
      </div>
    </div>
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
<script src="assets/modules/datatables/datatables.min.js"></script>
<script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script>
    let msg = '<?= isset($msg) ? $msg : '' ?>';
    let stat = '<?= isset($stat) ? $stat : '' ?>';

    $(document).ready(function(){
        if(msg){
          showToastr(stat, msg);
        } 
      });
    $(document).ready(function() {
        function initializeSelectric() {
                $('.selectric').selectric();
            }
            function updateDeleteButtons() {
                if ($('.anak').length > 1) {
                    $('.deleteAnak').show();
                } else {
                    $('.deleteAnak').hide();
                }
            }

            updateDeleteButtons();

            $('#tambahAnak').click(function() {
                event.preventDefault();
                if ($('.anak').length < 9) {
                    var anakHtml = `
                    <div class="row anak">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group mb-2">
                                        <label>Anggota Keluarga<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="nama_anggota[]" placeholder="Anak" id="nama_pasangan">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Jenis Kelamin<span class="text-danger">*</span> :</label>
                                        <select class="form-control selectric" name="jenis_kelamin[]" id="jkPasangan">
                                            <option selected="" disabled>Jenis Kelamin</option>
                                            <option value="P">Pria</option>
                                            <option value="W">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Status<span class="text-danger">*</span> :</label>
                                        <select class="form-control selectric" name="status_hubungan[]" id="statPasangan">
                                            <option selected="" disabled>Status Hubungan</option>
                                            <option value="Ayah">Ayah</option>
                                            <option value="Ibu">Ibu</option>
                                            <option value="Anak">Anak</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-danger deleteAnak">-</button>
                            </div>
                        </div>
                    </div>`;
                    
                    $('#anakContainer').append(anakHtml);
                    initializeSelectric();
                    updateDeleteButtons();
                } else {
                    alert('Maksimal 7 Anggota');
                }
            });

            $('#anakContainer').on('click', '.deleteAnak', function() {
                $(this).closest('.anak').remove();
                updateDeleteButtons();
            });
    });
    $(document).ready(function() {
            $('#relation').change(function() {
                if ($(this).is(':checked')) {
                    $('#pasanganRow').hide();
                    // $('#jkPasangan, #statPasangan').prop('disabled', true).selectric('refresh');
                } else {
                    $('#pasanganRow').show();
                    // $('#jkPasangan, #statPasangan').prop('disabled', false).selectric('refresh');
                    
                }
            });
    });

    function showAddBarang() {
      $('#barangModal').modal('show');
    }
    function detailBarang() {
      $('#barangModal').modal('show');
      $('#barangLabel').text('GSG-R1-FN-002 - Kursi');
      $('#namabarang').val('Kursi').prop('disabled',true);
      $('#catatan').val('Tipe: Informa, Warna: Hijau').prop('disabled',true);
      $('#harga').val('15,000').prop('disabled',true);
      $('#jumlah').val('100').prop('disabled',true);
    }

    function showToastr(type, message) {
        iziToast[type]({
            title: type,
            message: message,
            position: 'topRight',
            timeout: 3000,
        });
    }

      
    $.uploadPreview({
      input_field: "#image-upload",   // Default: .image-upload
      preview_box: "#image-preview",  // Default: .image-preview
      label_field: "#image-label",    // Default: .image-label
      label_default: "Choose File",   // Default: Choose File
      label_selected: "Change File",  // Default: Change File
      no_label: false,                // Default: false
      success_callback:  function() {
        $('#image-label').addClass('d-none');
      }
    });

    // document.getElementById('btnSave').addEventListener('click', function() {
    //   event.preventDefault();
    //   $('#barangModal').modal('hide');
    //   showToastr('success', "Sukses menyimpan Jenis Barang");
    // });
    // $('.number, .number-format').on('keyup', function () {
    //         this.value = this.value.replace(/[^\d.,]/g, ''); 
    //     });

    //     $('.number-format').on('blur', function () {
    //         const value = this.value.replace(/[^\d.,]/g, ''); 
    //         this.value = parseFloat(value.replace(',', '.'));
    //         if (!isFinite(this.value)) {
    //             this.value = '0';
    //         } else {
    //             this.value = parseFloat(value).toLocaleString('en-US', {style: 'decimal'});
    //         }
    //     });
</script>
</body>

</html>