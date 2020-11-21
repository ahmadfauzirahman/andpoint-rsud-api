<?php

use app\models\Absensi\MasterAbsensi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi\MasterAbsensi */

$this->title = 'Dashboard Absensi';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    /* .mcu-spesialis-audiometri-form {
        font-size: 10px;
    } */

    table {
        /* border-collapse: collapse; */
        font-size: 12px;
    }

    table td {
        padding: 4.800;
    }

    /* 
    .form-group {
        margin-bottom: 0px !important;
    }

    .tabel-tht label {
        margin-bottom: 0px !important;
    } */


    .tbl-mata tr th,
    .tbl-mata tr.td-garis td {
        border: 1px solid #000000;
        vertical-align: top;
    }

    .tbl-mata tr td {
        vertical-align: top;
    }

    .tabel-penata tr th,
    .tabel-penata tr td {
        border: 1px solid #000000;
        vertical-align: top;
    }

    /* .tbl-gigi .angka-gigi {
        text-align: center;
    } */

    /* .tbl-oklusi tr td.col-1 {
        width: 35%;
        border-left: 1px solid #000000;
        border-bottom: 1px solid #000000;
    }

    .tbl-oklusi tr td.col-2 {
        width: 1%;
        text-align: left;
        border-bottom: 1px solid #000000;
    }

    .tbl-oklusi tr td.col-3 {
        width: 64%;
        text-align: left !important;
        border-bottom: 1px solid #000000;
        border-right: 1px solid #000000;
    } */

    .tbl-ttd tr td.col-1 {
        border-left: 1px solid #000000;
        border-bottom: 1px solid #000000;
    }

    .tbl-ttd tr td.col-2 {
        border-bottom: 1px solid #000000;
    }

    .tbl-ttd tr td.col-3 {
        border-bottom: 1px solid #000000;
        border-right: 1px solid #000000;
    }
</style>

<?php Pjax::begin(['id' => 'pjax-absensi']); ?>
<div class="row">
    <div class="col-sm-8">
        <div class="card m-b-20 card-body">
            <h4 class="card-title text-center">Waktu Sekarang</h4>
            <h1 class="card-text text-center text-success">PUKUL <?= date('H:i:s') ?> WIB</h1>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card m-b-20 card-body">
            <h4 class="card-title text-center">Ambil Absen</h4>
            <p></p>
            <div class="card-text">
                <?php
                $absen = MasterAbsensi::find()
                    ->where(["tanggal_masuk" => date("Y-m-d")])
                    ->andWhere(['nip_nik' => Yii::$app->user->identity])
                    ->one();
                ?>
                <?php if (is_null($absen)) { ?>
                    <a href="javascript:void(0);" id="save-data-absen" onclick="save(this)" data-value="<?= Yii::$app->user->identity->kodeAkun ?>" class="btn btn-trans btn-block btn-success btn-rounded ">Klik Untuk Ambil Absensi Masuk</a>
                <?php } else if (is_null($absen->jam_keluar)) { ?>
                    <a href="javascript:void(0);" id="save-data-absen" onclick="save(this)" data-value="<?= Yii::$app->user->identity->kodeAkun ?>" class="btn btn-trans btn-block btn-primary btn-rounded ">Klik Untuk Ambil Absensi Pulang</a>
                <?php } else { ?>
                    <h4>Sampai Jumpa Besok Hari , Selamat Beristirahat</h4>
                <?php  } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                </div>
            </div>

            <h4 class="header-title mt-0 m-b-30">Lima Urutan Absen Terakhir</h4>

            <div class="inbox-widget nicescroll" style="height: 315px;">

                <?php if (count($absenHarini) >  0) { ?>
                    <?php foreach ($absenHarini as $itemAbsen) { ?>
                        <a href="#">
                            <div class="inbox-item">
                                <div class="inbox-item-img"><img src="<?= Url::to('@web/img/user.png') ?>" class="rounded-circle" alt=""></div>
                                <p class="inbox-item-author"><?= $itemAbsen->pegawai->nama_lengkap ?></p>
                                <p class="inbox-item-text"><?= $itemAbsen->how ?></p>
                                <p class="inbox-item-date"><?= $itemAbsen->jam_masuk ?> WIB</p>
                            </div>
                        </a>
                    <?php  } ?>
                <?php } else { ?>
                <?php } ?>


            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                </div>
            </div>

            <h4 class="header-title mt-0 m-b-30 text-center">Sistem Informasi Presensi dan Absensi</h4>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari & Tanggal</th>
                            <th>Nama</th>
                            <th style="text-align: center;">Jam Masuk [Lokasi]</th>
                            <th style="text-align: center;">Jam Pulang [Lokasi]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($absenHarini as $list_absen) { ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= date('D', strtotime($list_absen->tanggal_masuk)) . " , " . date('d-m-Y',strtotime($list_absen->tanggal_masuk)) ?></td>
                                <td><?= $list_absen->pegawai->nama_lengkap ?></td>
                                <td style="text-align: center;"><?= $list_absen->jam_masuk ?> WIB <br><span class="badge badge-success">Tepat Waktu</span></td>
                                <td style="text-align: center;"><?= $list_absen->jam_keluar ?> WIB</td>
                            </tr>

                        <?php
                            $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php Pjax::end(); ?>

<?php $this->registerJs($this->render('absensi-fun.js'), View::POS_END) ?>