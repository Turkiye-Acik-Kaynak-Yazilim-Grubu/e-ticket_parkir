            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Kendaraan</th>
                                            <th>Plat Nomor</th>
                                            <th>Pemilik</th>
                                            <th>Waktu Masuk</th>
                                            <th>Waktu Keluar</th>
                                            <th>--</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($pk as $t) {
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $t['tgl_parkir'] ?></td>
                                                <td><?= $t['merk'] ?></td>
                                                <td><?= $t['plat_nomor'] ?></td>
                                                <td><?= $t['title'] ?></td>
                                                <td><?= $t['waktu_masuk'] ?></td>
                                                <td><?= $t['waktu_keluar'] ?></td>
                                                <td>
                                                    <a href="<?= base_url("Petugas/del_parkir/" . $t['id_parkir']) ?>" class="btn btn-danger"> Hapus </a>
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