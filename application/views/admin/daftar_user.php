            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>--</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($users as $t) {
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $t['username'] ?></td>
                                                <td><?= $t['title'] ?></td>
                                                <td><?= $t['email'] ?></td>
                                                <td><?= $t['lvl'] ?></td>
                                                <td>
                                                    <?php if ($t['username'] != 'Admin') { ?>
                                                        <a href="<?= base_url("Admin/e_lvl/" . $t['id']) ?>" class="btn btn-info"> Edit </a>
                                                        <a href="<?= base_url("Admin/del_user/" . $t['id']) ?>" class="btn btn-danger"> Hapus </a>
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