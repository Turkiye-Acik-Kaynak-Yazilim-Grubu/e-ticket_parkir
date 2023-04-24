            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Merk</th>
                                            <th>Plat Nomor</th>
                                            <th>Pemilik</th>
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
                                                <td><?= $t['title'] ?></td>
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