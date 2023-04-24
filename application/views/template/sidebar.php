        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?= base_url() ?>" class="site_title">
                        <i class="fa fa-ticket"></i> <span>E-Ticket Parkir</span>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?= base_url("assets/") ?>images/<?= $user['image'] ?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?= $user['title'] ?></h2>
                    </div>
                </div>
                <br />
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">

                        <?php if ($this->session->userdata('role_id') == '1') { ?>
                            <h3>ADMIN</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?= base_url("Admin") ?>"><i class="fa fa-dashboard"></i> HOME</a></li>
                                <li><a href="<?= base_url("Admin/daftar_anggota") ?>"><i class="fa fa-user"></i> Daftar User</a></li>
                                <li><a href="<?= base_url("Admin/jenis_kendaraan") ?>"><i class="fa fa-dashboard"></i> Jenis Kendaraan</a></li>
                                <li><a href="<?= base_url("Admin/kendaraan") ?>"><i class="fa fa-car"></i> Kendaraan</a></li>
                                <li><a href="<?= base_url("Admin/parkir") ?>"><i class="fa fa-pinterest"></i> Parkir</a></li>
                            </ul>
                        <?php }

                        if ($this->session->userdata('role_id') == '2') { ?>
                            <h3>PETUGAS</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?= base_url("Petugas") ?>"><i class="fa fa-dashboard"></i> HOME</a></li>
                                <li><a href="<?= base_url("User") ?>"><i class="fa fa-th"></i> QR-Code</a></li>
                                <li><a href="<?= base_url("Petugas/parkir") ?>"><i class="fa fa-pinterest"></i> Parkir</a></li>
                            </ul>
                        <?php } ?>


                        <h3>ANGGOTA</h3>
                        <ul class="nav side-menu">
                            <?php if (($this->session->userdata('role_id') != '1') && ($this->session->userdata('role_id') != '2')) { ?>
                                <li><a href="<?= base_url("User") ?>"><i class="fa fa-dashboard"></i> HOME</a></li>
                            <?php } ?>
                            <li><a href="<?= base_url("User/kendaraanKu") ?>"><i class="fa fa-car"></i> Kendaraan Saya</a></li>
                            <li><a href="<?= base_url("Auth/logout") ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>