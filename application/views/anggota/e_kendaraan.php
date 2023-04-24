            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <form method="POST" action="<?= base_url("User/e_kendaraan/" . $kn['id_kendaraan']) ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="jns">
                                        Jenis Kendaraan
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id="jns" name="jns" required="required" class="form-control">
                                            <option value="<?= $kn['id_jenis_kendaraan'] ?>" hidden=""></option>
                                            <?php foreach ($jns as $t) { ?>
                                                <option value="<?= $t['id_jenis'] ?>">
                                                    <?= $t['jenis_kendaraan'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="merk">
                                        Merk
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="merk" name="merk" required="required" class="form-control" value="<?= $kn['merk'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="plat">
                                        Plat Nomor
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="plat" name="plat" required="required" class="form-control" value="<?= $kn['plat_nomor'] ?>">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="text-center">
                                        <a class="btn btn-success" href="<?= base_url("User/kendaraanKu") ?>">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>