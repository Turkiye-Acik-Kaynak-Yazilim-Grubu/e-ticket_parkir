          <div class="row">
            <?php foreach ($kendaraan as $t) : ?>

              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <div class="row text-center">
                      <img src="<?= base_url("assets/images/qrcode/" . $t['qrcode']) ?>" width="100%">
                    </div>
                    <h3 class="text-center"><?= $t['plat_nomor'] ?></h3>
                    <h4 class="text-center"><?= $t['merk'] ?></h4>

                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          </div>