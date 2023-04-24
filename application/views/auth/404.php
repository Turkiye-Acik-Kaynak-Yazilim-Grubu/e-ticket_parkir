<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('template/head') ?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-12">
                <div class="col-middle">
                    <div class="text-center text-center">
                        <h1 class="error-number">404</h1>
                        <h2>Sorry but we couldn't find this page</h2>
                        <p>This page you are looking for does not exist <a href="<?= base_url() ?>">Back to Dahsboard</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url("assets/") ?>vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url("assets/") ?>vendors/nprogress/nprogress.js"></script>
    <script src="<?= base_url("assets/") ?>build/js/custom.min.js"></script>
</body>

</html>