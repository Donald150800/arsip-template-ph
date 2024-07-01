<?php
include 'modules/sektor/sektor.php';
include 'partials/header.php';
?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <button class="btn btn-icon trigger--fire-modal-2" data-toggle="modal" data-target="#modal1"
          onclick="history.back()"><i class="fas fa-arrow-left"></i></button>
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
              <form id="formSektor">
                  <div class="form-group mb-0">
                      <label>Inisial sektor</label>
                      <input type="text" class="form-control" placeholder="Inisial Sektor" name="inisial_sektor" id="inisialSektor" maxlength="3">
                  </div>
                  <div class="form-group mb-0">
                      <label>Nama Sektor</label>
                      <input type="text" class="form-control" placeholder="Nama Sektor" name="nama_sektor" id="namaSektor">
                  </div>
                  <div class="form-group mb-0">
                      <label>Deskripsi</label>
                      <textarea class="form-control validate" placeholder="Deskripsi" style="height: 50px;" name="deskripsi_sektor" id="deskripsiSektor"></textarea>
                  </div>
                  <div class="form-group mb-1">
                      <div class="col-sm-12">
                          <button type="button" class="btn btn-primary float-md-right" id="btnSave">Save</button>
                          <button type="reset" class="btn btn-warning float-md-right mr-1" id="btnReset">Reset</button>
                      </div>
                  </div>
              </form>
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
                      <td><a href="#" class="btn-show"
                          data-id='<?= $row["kd_sektor"] ?>'><?= $row['inisial_sektor']?></a></td>
                      <td><?= $row['nama_sektor']?></td>
                      <td>
                        <a href="#" class="btn btn-secondary btn-sm btn-edit" data-id='<?= $row["kd_sektor"] ?>'><i
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
    </div>
  </section>
</div>

<script src="<?= $base_url?>node_modules/prismjs/prism.js"></script>
<script src="<?= $base_url?>node_modules/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?= $base_url?>node_modules/sweetalert/dist/sweetalert.min.js"></script>
<script>
  let msg = '<?= isset($msg) ? $msg : '' ?>';
  let stat = '<?= isset($stat) ? $stat : '' ?>';

  function showToastr(type, message) {
    iziToast[type]({
      title: type,
      message: message,
      position: 'topRight',
      timeout: 3000,
    });
  }

  let tblSektor;
$(document).ready(function () {
    $('#btnReset').addClass('d-none');
    $('.btn-edit').click(function (event) {
        event.preventDefault();
        var type = 'edit';
        let id = $(this).data('id');
        getData(id, type);
    });
    $('.btn-show').click(function (event) {
        event.preventDefault();
        var type = 'show';
        let id = $(this).data('id');
        getData(id, type);
    });
    if (msg) {
        showToastr(stat, msg);
    }

    tblSektor = $('#sektorTable').DataTable({
        responsive: true,
        pageLength: 5, // Set the number of rows per page
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
    });
});

  function resetUpdate() {
    event.preventDefault();
    $('#inisialSektor').val('').prop('disabled', false);
    $('#namaSektor').val('').prop('disabled', false);
    $('#deskripsiSektor').val('').prop('disabled', false);
    $('#btnReset').addClass('d-none');
  }

  $('#btnSave').click(function() {
    var formData = $('#formSektor').serialize();
    $.ajax({
        url: '<?= $base_url ?>/modules/sektor/sektor.php', // Sesuaikan dengan path ke controller PHP Anda
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
              showToastr('success', response.message);
              $('#formSektor')[0].reset(); // Reset form setelah berhasil
              tblSektor.ajax.reload(null, false); // Memuat ulang data tabel setelah berhasil menambahkan data
            } else {
                showToastr('error', response.message);
            }
        },
        error: function(xhr, status, error) {
            showToastr('error', 'Terjadi kesalahan saat mengirim data');
        }
    });
});


  function getData(id, type) {
    $.ajax({
      url: 'sektor.php',
      type: 'GET',
      data: {
        id: id,
        type: type,
      },
      success: function (response) {
        data = JSON.parse(response);

        if (type == 'edit') {
          $('#inisialSektor').val(data.inisial_sektor).prop('disabled', false);
          $('#namaSektor').val(data.nama_sektor).prop('disabled', false);
          $('#deskripsiSektor').val(data.deskripsi).prop('disabled', false);
          $('#btnReset').removeClass('d-none');
        } else if (type == 'show') {
          $('#inisialSektor').val(data.inisial_sektor).prop('disabled', true);
          $('#namaSektor').val(data.nama_sektor).prop('disabled', true);
          $('#deskripsiSektor').val(data.deskripsi).prop('disabled', true);
          $('#btnReset').removeClass('d-none');
        }
      },
      error: function (xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }

  function deleteData(id) {
    $.ajax({
      url: 'sektor.php',
      type: 'GET',
      data: {
        method: 'hapus',
        id: id
      },
      success: function (response) {
        console.log(response);
        location.reload();
      },
      error: function (xhr, status, error) {
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

<?php include 'partials/footer.php';?>