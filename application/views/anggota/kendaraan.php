            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <a href="<?= base_url("User/i_kendaraan") ?>" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Kendaraan
                            </a>
                        </div>
                        <div class="x_content">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Merk</th>
                                            <th>Plat Nomor</th>
                                            <th>--</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($kendaraan as $t) {
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $t['jenis_kendaraan'] ?></td>
                                                <td><?= $t['merk'] ?></td>
                                                <td><?= $t['plat_nomor'] ?></td>
                                                <td>
                                                    <a href="<?= base_url("User/e_kendaraan/" . $t['id_kendaraan']) ?>" class="btn btn-info"> Edit </a>
                                                    <a href="<?= base_url("User/del_kendaraan/" . $t['id_kendaraan']) ?>" class="btn btn-danger"> Hapus </a>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>