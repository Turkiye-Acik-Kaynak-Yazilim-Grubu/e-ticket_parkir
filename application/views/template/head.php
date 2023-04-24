<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul ?></title>

    <link href="<?= base_url("assets/") ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url("assets/") ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url("assets/") ?>vendors/nprogress/nprogress.css" rel="stylesheet">

    <link href="<?= base_url("assets/") ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url("assets/") ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url("assets/") ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url("assets/") ?>build/css/custom.min.css" rel="stylesheet">

    <?php if ($this->session->userdata('role_id') == '2') { ?>
        <script src="<?= base_url("webcodecam/") ?>js/jquery.min.js"></script>
        <script src="<?= base_url("webcodecam/") ?>js/bootstrap.min.js"></script>
    <?php } ?>

</head>