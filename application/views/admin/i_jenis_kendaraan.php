            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php } ?>
                            <form method="POST" action="<?= base_url("Admin/i_jenis_kendaraan") ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="jns">
                                        Jenis Kendaraan
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="jns" name="jns" required="required" class="form-control" value="<?= set_value('jns') ?>">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="text-center">
                                        <a class="btn btn-success" href="<?= base_url("Admin/jenis_kendaraan") ?>">Cancel</a>
                                        <button class="btn btn-danger" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>