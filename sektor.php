<?php
include 'modules/sektor/sektor.php';
include 'partials/header.php';
// var_dump($res);

?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <button class="btn btn-icon trigger--fire-modal-2" data-toggle="modal" data-target="#modal1" onclick="history.back()"><i class="fas fa-arrow-left"></i></button>
            </div>
              <h1>DATA SEKTOR</h1>
          </div>
          <div class="section-body">
            <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
              <div class="card mb-1">
                <div class="card-header">
                  <h4>Input Sektor</h4>
                </div>
                <div class="card-body pt-1">
                  <form id="f1">
                    <input type="hidden" name="act" id="act" value="do_add">
                    <input type="hidden" name="kd_sektor" id="kd_sektor" value="">
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
                      <button type="submit" class="btn btn-primary float-md-right" id="btnSave">Save</button>
                      <button type="submit" class="btn btn-warning float-md-right d-none mr-1" id="btnReset" onclick="resetUpdate()">Reset</button>
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
                  <table class="table table-striped" id="sektorTable" role="grid" aria-describedby="table-2_info">
                    <thead>
                      <tr role="row">
                        <th>Kode Sektor</th>
                        <th>Nama Sektor</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data as $row): ?>
                      <tr role="row">
                        <td><?= $row['inisial_sektor']?></td>
                        <td><?= $row['nama_sektor']?></td>
                        <td>
                          <a href="#" class="btn btn-secondary btn-sm btn-edit" onclick="getData(<?= $row['kd_sektor'] ?>)"><i
                              class="fas fa-edit"></i></a>
                          <a href="#" onclick="deleteData(<?= $row['kd_sektor'] ?>)"
                            class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
          </div>
      </section>
      </div>
      
      <?php include 'partials/footer.php';?>

  <!-- Page Specific JS File -->
  <script src="node_modules/prismjs/prism.js"></script>
<script src="node_modules/izitoast/dist/js/iziToast.min.js"></script>
<script> 

  $(document).ready(function() {
    let msg = '<?= isset($msg) ? $msg : '' ?>';
    let stat = '<?= isset($stat) ? $stat : '' ?>';

    function showToastr(type, message) {
        iziToast[type]({
            title: type.charAt(0).toUpperCase() + type.slice(1),
            message: message,
            position: 'topRight',
            timeout: 3000,
        });
    }

    // Cek apakah ada pesan toastr di localStorage
    let toastrMessage = localStorage.getItem('toastrMessage');
    let toastrType = localStorage.getItem('toastrType');

    if (toastrMessage) {
        // Tampilkan toastr
        showToastr(toastrType, toastrMessage);

        // Hapus pesan dari localStorage
        localStorage.removeItem('toastrMessage');
        localStorage.removeItem('toastrType');
    }

    var tblSektor = $('#sektorTable').DataTable({
        responsive: true,
        pageLength: 4, // Set the number of rows per page
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
    });

    $('#btnSave').click(function(event) {
        event.preventDefault();
        swal({
            title: "Apakah data sektor sudah benar?",
            icon: "info",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            }
        }).then((isConfirm) => {
            if (isConfirm) {
                var formData = $('#f1').serialize();
                $.ajax({
                    url: '<?= $base_url ?>modules/sektor/sektor.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Jika berhasil, lakukan tindakan berikut
                            location.reload(); // Reload halaman
                            localStorage.setItem('toastrMessage', response.message);
                            localStorage.setItem('toastrType', response.status);
                            $('#f1')[0].reset(); // Reset form setelah berhasil
                        } else {
                            // Jika terjadi kesalahan dari sisi server
                            showToastr('error', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Jika terjadi kesalahan pada saat mengirim data (AJAX error)
                        showToastr('error', 'Terjadi kesalahan saat mengirim data');
                    }
                });
            } else {
                // Jika pengguna membatalkan dialog, tidak perlu melakukan apa pun
                console.log("Pengguna membatalkan aksi.");
            }
        });
    });

  });

function resetUpdate() {
    event.preventDefault();
    $('#kd_sektor').val('');
    $('#inisialSektor').val('');
    $('#namaSektor').val('');
    $('#deskripsiSektor').val('');
    $('#act').val('do_add');
    $('#btnReset').addClass('d-none');
}

function getData(id, type) {
    $.ajax({
        url: '<?= $base_url ?>modules/sektor/sektor.php',
        type: 'GET',
        data: { 
            method: 'editDataSektor',
            id: id,
        },
        success: function(response) {
            data = JSON.parse(response);
            $('#kd_sektor').val(data.kd_sektor);
            $('#inisialSektor').val(data.inisial_sektor);
            $('#namaSektor').val(data.nama_sektor);
            $('#deskripsiSektor').val(data.deskripsi);
            $('#act').val('do_update');
            $('#btnReset').removeClass('d-none');
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function deleteData(id) {
    $.ajax({
        url: '<?= $base_url ?>modules/sektor/sektor.php',
        type: 'GET',
        data: { 
            method: 'deleteSektor',
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