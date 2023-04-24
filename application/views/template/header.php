<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('template/head') ?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php $this->load->view('template/sidebar') ?>

            <?php $this->load->view('template/topbar') ?>

            <div class="right_col" role="main">
                <div class="">
                    <?php if ($judul != 'Dashboard') { ?>
                        <div class="page-title">
                            <div class="title_left">
                                <h3><?= $judul ?></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    <?php } ?>