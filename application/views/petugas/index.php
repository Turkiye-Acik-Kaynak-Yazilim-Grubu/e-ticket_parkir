        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h3 class="panel-title">Arahkan Kode QR Ke Kamera!</h3>
              </div>
              <div class="x_content text-center">

                <div class="row">
                  <canvas></canvas>
                  <hr>
                  <div class="col-md-4 col-sm-1"></div>
                  <div class="col-md-4 col-sm-8 col-xs-12">
                    <select class="form-control"></select>
                  </div>
                  <div class="col-md-4 col-sm-1"></div>
                </div>

                <hr>
                <div class="row" id="notif">
                  <?= $this->session->flashdata('message'); ?>
                  <?php if ($pk != null) { ?>
                    <div class="table-responsive">
                      <table id="datatable" class="table table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Kendaraan</th>
                            <th>Plat Nomor</th>
                            <th>Pemilik</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1;
                          foreach ($pk as $t) {
                          ?>
                            <tr>
                              <td><?= $no; ?></td>
                              <td><?= $t['merk'] ?></td>
                              <td><?= $t['plat_nomor'] ?></td>
                              <td><?= $t['title'] ?></td>
                              <td><?= $t['waktu_masuk'] ?></td>
                              <td>
                                <?php
                                $waktu = $t['waktu_keluar'];
                                if ($waktu == '0000-00-00 00:00:00') {
                                  echo "Belum Keluar";
                                } else {
                                  echo $waktu;
                                }
                                ?>
                              </td>
                            </tr>
                          <?php $no++;
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  <?php } ?>
                </div>

              </div>
            </div>
          </div>
        </div>