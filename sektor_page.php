<?php
include 'modules/sektor/sektor.php';


// var_dump($row);die();
include "partials/header.php"
?>
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
                foreach ($res as $row) {
                 ?> 
              <div class="col-lg-6">
                  <div class="card card-large-icons position-relative">
                    <div class="card-body position-relative">
                      <div class="row">
                        <div class="col-4">
                          <h3 id="ministryCard">
                            <a href="sektor_keluarga.php?ids=<?= $row['inisial_sektor'] ?>">
                              <?= $row['nama_sektor'] ?>     
                          </a> 
                        </h3>
                      </div>
                      <div class="col-2">
                        <li class="media">
                          <div class="media-body ml-4">
                            <div class="media-title">Keluarga</div>
                            <div class="text-small text-muted"><?= $row['total_keluarga'] ?></div>
                          </div>
                        </li>
                      </div>
                      <div class="col-2">
                        <li class="media">
                          <div class="media-body ml-4">
                            <div class="media-title">Jemaat</div>
                            <div class="text-small text-muted"><?= $row['total_anggota_keluarga'] ?></div>
                          </div>
                        </li>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <?php }?>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php include "partials/footer.php"?>
  <!-- Page Specific JS File -->
  <script src="node_modules/prismjs/prism.js"></script>
<script src="node_modules/izitoast/dist/js/iziToast.min.js"></script>
<script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>