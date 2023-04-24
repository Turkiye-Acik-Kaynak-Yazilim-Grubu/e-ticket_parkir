            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form method="POST" action="<?= base_url("Admin/p_e_lvl/" . $users['id']) ?>" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama">
                                        Nama
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nama" name="nama" disabled class="form-control" value="<?= $users['title'] ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="lvl">
                                        Level
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select name="lvl" id="lvl" class="form-control">
                                            <option value="<?= $users['lvl'] ?>" hidden></option>
                                            <option value="1">Admin</option>
                                            <option value="2">Petugas</option>
                                            <option value="3">User</option>
                                        </select>
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