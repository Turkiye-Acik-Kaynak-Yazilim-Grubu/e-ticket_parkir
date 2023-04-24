            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php } ?>
                            <?= $this->session->flashdata('message'); ?>
                            <form method="POST" action="<?= base_url("User/e_password") ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="current_password">
                                        Current Password
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="password" id="current_password" name="current_password" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="new_password1">
                                        New Password
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="password" id="new_password1" name="new_password1" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="new_password2">
                                        Confirm Password
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="password" id="new_password2" name="new_password2" required="required" class="form-control">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="text-center">
                                        <a class="btn btn-success" href="<?= base_url("User/profile") ?>">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>