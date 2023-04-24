        <div>
            <div class="login_wrapper">
                <div class="form login_form">
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php } ?>
                    <section class="login_content">
                        <form class="form-horizontal" method="post" action="<?= base_url("Auth/registrasi") ?>">
                            <h1>Daftar Anggota</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?= set_value('username') ?>" />
                            </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Password" name="password" />
                            </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?= set_value('nama') ?>" />
                            </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ?>" />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <p class="change_link">Sudah Punya Akun ?
                                    <a href="<?= base_url("Auth") ?>"> Log in </a>
                                </p>
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1><i class="fa fa-ticket"></i> <span>E-Ticket Parkir</span></h1>
                                    <p>©2020 All Rights Reserved. I'm Posible</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>