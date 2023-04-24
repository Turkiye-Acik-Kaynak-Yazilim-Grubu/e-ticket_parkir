<div class="row">
    <div class="col-md-4 col-sm-9 col-xs-12">
        <div class="x_panel">
            <div class="x_content">

                <?= $this->session->flashdata('message'); ?>

                <div class="col-md-12 col-sm-12 profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            <img class="img-responsive avatar-view" src="<?= base_url("assets/images/") . $user['image'] ?>" alt="Avatar">
                        </div>
                    </div>
                    <h3><?= $user['title'] ?></h3>
                    <ul class="list-unstyled user_data">
                        <li>
                            <i class="fa fa-map-marker user-profile-icon"></i> <?= $user['lvl'] ?>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o user-profile-icon"></i> <?= $user['email'] ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>