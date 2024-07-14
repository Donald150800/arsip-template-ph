<?php
include 'modules/keluarga/keluarga.php';
include 'partials/header.php';
?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <button class="btn btn-icon trigger--fire-modal-2" data-toggle="modal" data-target="#modal1" onclick="history.back()"><i class="fas fa-arrow-left"></i></button>
            </div>
              <h1>Data Keluarga - Sektor <?= $data['nama_sektor'] ?></h1>
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
                              <table class="table table-striped" id="keluargaTable" class="display" role="grid" aria-describedby="table-2_info">
                                  <thead>
                                    <tr>
                                      <th class="text-center"> Kode Keluarga</th>
                                      <th>Nama Keluarga</th>
                                      <th>Jumlah Anggota</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
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
      <div class="modal fade" id="keluargaModal" tabindex="-1" role="dialog" aria-labelledby="ministryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header pb-3 pt-3" style="background-color: #06548A; color: white;">
                  <h5 class="modal-title" id="formLabel">Data Keluarga</h5> 
              </div>
              <div class="modal-body pb-0">
                  <form id="f2" enctype="multipart/form-data">
                    <input type="hidden" name="kd_sektor" value="<?= $data['kd_sektor']?>">
                    <input type="hidden" name="act" id="act" value="do_add">
                    <input type="hidden" name="kode_ref" value="" id="kodeRef">
                    <input type="hidden" name="kd_keluarga" value="" id="kdKel">
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
                                                    <input type="text" class="form-control" name="kd_ref_keluarga" value="<?= $data['kode_keluarga']?>" id="kd_ref_kel" readonly="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label>Nama Keluarga </label>
                                                    <input type="text" class="form-control" name="nama_keluarga" placeholder="Nama Keluarga / Nama Kepala Keluarga" id="nama_kel">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-2">
                                                    <label>Alamat Rumah :</label>
                                                    <textarea class="form-control validate" name="alamat_keluarga" placeholder="Alamat Rumah" style="height: 145px;" id="alamat_kel"></textarea>
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
                                  <div id="anakContainer" class="d-none">
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
                                <div id="detailContainer">
                                  
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        Dokumen Keluarga :
                                    </div>
                                    <div class="col-4">
                                        <div id="uploadBox">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file_keluarga" id="file_keluarga">
                                                <label class="custom-file-label" id="fileUploadName" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div id="fileBox">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="modal-footer pt-3">
                  <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                  <button type="button" onclick="cancelEdit()" id="btnCancel" class="btn btn-default d-none">Cancel</button>
                  <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                  <button type="button" onclick="editData()" id="btnEdit" class="btn btn-warning d-none">Edit</button>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
<?php include 'partials/footer.php';?>

  <!-- Page Specific JS File -->
  <script src="node_modules/prismjs/prism.js"></script>
<script src="node_modules/izitoast/dist/js/iziToast.min.js"></script>
<script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="assets/modules/tooltip.js"></script>
<script>
  let tblKeluarga;
  let kdSektor = <?= $data['kd_sektor']?>;

  function initializeSelectric() {
      $('.selectric').selectric();
  }
    $(document).ready(function(){
      
    tblKeluarga = $('#keluargaTable').DataTable({
      responsive: true,
      pageLength: 10,
      paging: true,
      pagingType: 'simple_numbers',
      lengthChange: false,
      ordering: true,
      info: true,
      autoWidth: false,
      language: { 
          search: "_INPUT_",
          searchPlaceholder: "Search..."
      },
      ajax: {
          url: '<?= $base_url ?>modules/keluarga/keluarga.php',
          type: 'POST',
          data: {
            method: 'getAll',
            kd_sektor: kdSektor
          },
          dataSrc: ''
      },
      columns: [
          {
            data: 'kd_ref_keluarga',
            render: function (data, type, row) {
                return `<a href="#" onclick="detailData(${row.kd_keluarga})">${data}</a>`;
            }
          },
          { data: 'nama_keluarga' },
          { data: 'total_anggota_keluarga' },
          {
            data: 'nama_file',
            render: function (data, type, row) {
                if (data) {
                    return `
                        <center>
                            <a href="#" class="btn btn-warning btn-sm btn-edit" onclick="downloadFile('${data}')">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a href="#" onclick="deleteData(${row.kd_keluarga})" class="btn btn-danger btn-sm btn-delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </center>
                    `;
                } else {
                    return `
                        <center>
                            <a href="#" class="btn btn-secondary btn-sm btn-edit" data-toggle="tooltip" data-placement="left" title="File Not Available">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a href="#" onclick="deleteData(${row.kd_keluarga})" class="btn btn-danger btn-sm btn-delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </center>
                        `;
                    }
                }
            }
      ]
    });

      $('#btnSave').click(function(event) {
        event.preventDefault();
        swal({
            title: "Apakah data keluarga sudah benar?",
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
                var form = $('#f2')[0];
                var formData = new FormData(form);
                formData.append('method', 'insertKeluarga');
                $.ajax({
                    url: '<?= $base_url ?>modules/keluarga/keluarga.php',
                    type: 'POST',
                    data: formData,
                    contentType: false, // Mencegah jQuery dari menimpa tipe konten
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            showToastr(response.status, response.message);
                            $('#f2')[0].reset();
                            $('#keluargaModal').modal('hide'); 
                            tblKeluarga.ajax.reload();
                        } else {
                            showToastr('error', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Jika terjadi kesalahan pada saat mengirim data (AJAX error)
                        console.log(error);
                        showToastr('error', 'Terjadi kesalahan saat mengirim data');
                    }
                });
            } else {
                // Jika pengguna membatalkan dialog, tidak perlu melakukan apa pun
                console.log("Pengguna membatalkan aksi.");
            }
        });
    });

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
                                        <input type="text" class="form-control" name="nama_anggota[]" placeholder="Anggota Keluarga" id="nama_pasangan">
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

    function editData(){
      event.preventDefault();
      $('#nama_kel').prop('disabled', false);
      $('#alamat_kel').prop('disabled', false);
      $('#btnSave').removeClass('d-none');
      $('#btnCancel').removeClass('d-none');
      $('#btnEdit').addClass('d-none');
      $('#btnClose').addClass('d-none');
      $('#tambahAnak').removeClass('d-none');
      $('#detailContainer').addClass('d-none');
      $('#anakContainer').removeClass('d-none');
      $('.anggota').prop('disabled', false);
      $('.jkel').prop('disabled', false);
      $('.statushub').prop('disabled', false);
      $('#act').val('do_update');
      $('#uploadBox').removeClass('d-none');
      $('#fileBox').addClass('d-none');
      initializeSelectric();
    }

    function cancelEdit(){
      event.preventDefault();
      $('.selectric').selectric('destroy');
      $('#nama_kel').prop('disabled', true);
      $('#alamat_kel').prop('disabled', true);
      $('#btnSave').addClass('d-none');
      $('#btnCancel').addClass('d-none');
      $('#btnEdit').removeClass('d-none');
      $('#tambahAnak').addClass('d-none');
      $('#btnClose').removeClass('d-none');
      $('#detailContainer').removeClass('d-none');
      $('.anggota').prop('disabled', true);
      $('.jkel').prop('disabled', true);
      $('.statushub').prop('disabled', true);
      $('#act').val('do_add');
    }

    function detailData(kdKeluarga){ 
      $.ajax({
        url: '<?= $base_url ?>modules/keluarga/keluarga.php',
        type: 'GET',
        data: { 
            method: 'getDetail',
            id: kdKeluarga,
        },
        success: function(response) {
            // console.log(response);
            $('#keluargaModal').modal('show');
            $('#detailContainer').addClass('d-none');
            $('#anakContainer').removeClass('d-none');
            $('#tambahAnak').addClass('d-none');
            $('#btnSave').addClass('d-none');
            $('#btnEdit').removeClass('d-none');

            var data = JSON.parse(response);
            var anggota = data.anggota;
            var klg = data.keluarga;

            $('#formLabel').text(klg.kd_ref_keluarga+' - Kel. '+klg.nama_keluarga);
            $('#kdKel').val(klg.kd_keluarga);
            $('#kodeRef').val(klg.kd_ref_keluarga);
            $('#fileUploadName').text(klg.nama_file);
            $('#uploadBox').addClass('d-none');
            if(klg.nama_file == '' || klg.nama_file == null){
                $('#fileBox').text('Belum ada file yang di upload');
            }else{
                $('#fileBox').html('<a href="#" onclick="downloadFile(\'' + klg.nama_file + '\')">' + klg.nama_file + '</a>');
            }
            $('#kd_ref_kel').val(klg.kd_ref_keluarga).prop('disabled', true);
            $('#nama_kel').val(klg.nama_keluarga).prop('disabled', true);
            $('#alamat_kel').val(klg.alamat_keluarga).prop('disabled', true);

            // Container untuk detail anggota keluarga
            var detailContainer = $('#detailContainer');
            var anakContainer = $('#anakContainer');
            detailContainer.empty(); // Kosongkan container sebelumnya
            anakContainer.empty(); // Kosongkan container sebelumnya

            // Looping data anggota dan buat card untuk setiap anggota
            anggota.forEach(function(item) {
                var jkel = (item[1] == 'W')? 'Wanita' : 'Pria';

                var anakHtml = `
                    <div class="row anak">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Anggota Keluarga<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control anggota" name="nama_anggota[]" placeholder="Anggota Keluarga" value="${item[0]}" disabled>
                                        <input type="hidden" name="kd_anggota[]" value="${item[3]}"> 
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Jenis Kelamin<span class="text-danger">*</span> :</label>
                                        <select class="form-control jkel selectric" name="jenis_kelamin[]" disabled>
                                            <option value="P" ${item[1] == 'P' ? 'selected' : ''}>Pria</option>
                                            <option value="W" ${item[1] == 'W' ? 'selected' : ''}>Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Status<span class="text-danger">*</span> :</label>
                                        <select class="form-control statushub selectric" name="status_hubungan[]" disabled>
                                            <option value="Ayah" ${item[2] == 'Ayah' ? 'selected' : ''}>Ayah</option>
                                            <option value="Ibu" ${item[2] == 'Ibu' ? 'selected' : ''}>Ibu</option>
                                            <option value="Anak" ${item[2] == 'Anak' ? 'selected' : ''}>Anak</option>
                                            <option value="Lainnya" ${item[2] == 'Lainnya' ? 'selected' : ''}>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-0">
                                <button class="btn btn-danger deleteAnak d-none">-</button>
                            </div>
                        </div>                                    
                    </div>
                `;
                  
                anakContainer.append(anakHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
     });
    }

    function downloadFile(fileName) {
    // Membuat URL lengkap dari server root dan path file
    var url = '<?php echo $base_url; ?>assets/uploads/' + fileName;
    var a = document.createElement("a");
    a.href = url;
    var arr = url.split('/');
    var namaFile = arr[arr.length - 1];
    a.download = namaFile; // Rename File
    a.style.display = "none";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    showToastr('info','File is being downloaded.');
}


    $(document).ready(function() {
      $('#relation').change(function() {
          if ($(this).is(':checked')) {
              $('#pasanganRow').hide();
          } else {
              $('#pasanganRow').show();
          }
      });
    });

    function showAddBarang() {
      $('#keluargaModal').modal('show');
      $('#detailContainer').addClass('d-none');
      $('#anakContainer').removeClass('d-none');
      $('#tambahAnak').removeClass('d-none');
      $('#formLabel').text('Data Keluarga');
      $('#kd_ref_kel').val('<?= $data['kode_keluarga']?>').prop('disabled', false);
      $('#nama_kel').val('').prop('disabled', false);
      $('#alamat_kel').val('').prop('disabled', false);
      $('#btnSave').removeClass('d-none');
      $('#btnClose').removeClass('d-none');
      $('#uploadBox').removeClass('d-none');
      $('#fileBox').addClass('d-none');
      $('#btnEdit').addClass('d-none');
      $('#anakContainer').empty();
      $('#fileUploadName').text('Choose File');
      $('#act').val('do_add');

      var newcontainer = `<div class="row anak">
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
                                        </div>`;
          $('#anakContainer').append(newcontainer);
          initializeSelectric();
    }

    function showToastr(type, message) {
        iziToast[type]({
            title: type,
            message: message,
            position: 'topRight',
            timeout: 3000,
        });
    }

    function deleteData(id) {
    event.preventDefault();
            swal({
                title: "Apakah anda yakin akan menghapus data keluarga ini?",
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
                    $.ajax({
                      url: '<?= $base_url ?>modules/keluarga/keluarga.php',
                      type: 'POST',
                      data: { 
                          method: 'deleteKeluarga',
                          id: id
                      },
                      success: function(response) {
                        response = JSON.parse(response);
                        showToastr(response.status, response.message);
                        tblKeluarga.ajax.reload();
                      },
                      error: function(xhr, status, error) {
                          console.error('Error:', error);
                      }
                  })
                } else {
                    console.log("Pengguna membatalkan aksi.");
                }
            });
      }

    $(document).on('change', '.custom-file-input', function(event) {
        var inputFile = event.currentTarget;
        $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
    });
</script>
</body>

</html>