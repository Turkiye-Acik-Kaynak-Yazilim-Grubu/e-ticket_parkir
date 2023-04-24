            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form method="POST" action="<?= base_url("Petugas/e_parkir/" . $pk['id_parkir']) ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="merk">
                                        Merk
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="merk" name="merk" disabled class="form-control" value="<?= $pk['merk'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="plat">
                                        Plat Nomor
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="plat" name="plat" disabled class="form-control" value="<?= $pk['plat_nomor'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">
                                        Pemilik
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nama" name="nama" disabled class="form-control" value="<?= $pk['title'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tgl">
                                        Tanggal Parkir
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="tgl" name="tgl" disabled class="form-control" value="<?= $pk['tgl_parkir'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="masuk">
                                        Waktu Masuk
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="masuk" name="masuk" disabled class="form-control" value="<?= $pk['waktu_masuk'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="keluar">
                                        Waktu Keluar
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="date" id="keluar" name="keluar" class="form-control" value="<?= $pk['waktu_masuk'] ?>">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="text-center">
                                        <a class="btn btn-success" href="<?= base_url("Admin/daftar_anggota") ?>">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>