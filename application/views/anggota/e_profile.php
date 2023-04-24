            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form method="POST" action="<?= base_url("User/e_profile") ?>" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">
                                        Nama
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nama" name="nama" required="required" class="form-control" value="<?= $user['title'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">
                                        Email
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="email" name="email" required="required" class="form-control" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="almt">
                                        Alamat
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="almt" name="almt" required="required" class="form-control" value="<?= $user['alamat'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="avt">
                                        Avatar
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div class="col-md-3 col-sm-3 ">
                                            <img src="<?= base_url('assets/images/') . $user['image']; ?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-md-9 col-sm-9 ">
                                            <input type="file" id="avt" name="image" class="form-control">
                                        </div>
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