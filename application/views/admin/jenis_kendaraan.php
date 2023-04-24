            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <a href="<?= base_url("Admin/i_jenis_kendaraan") ?>" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Jenis Kendaraan
                            </a>
                        </div>
                        <div class="x_content">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis kendaraan</th>
                                            <th>--</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($jk as $t) {
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $t['jenis_kendaraan'] ?></td>
                                                <td>
                                                    <a href="<?= base_url("Admin/e_jenis/" . $t['id_jenis']) ?>" class="btn btn-info"> Edit </a>
                                                    <?php
                                                    if ($t['id_jenis'] > 2) {
                                                    ?>
                                                        <a href="<?= base_url("Admin/del_jenis/" . $t['id_jenis']) ?>" class="btn btn-danger"> Hapus </a>
                                                    <?php } ?>
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