<?php

/* @var $this yii\web\View */

use app\components\Helper;
use app\models\Absensi\MasterAbsensi;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\MasterPegawai;
use app\models\Kepegawaian\MasterRiwayatPenempatan;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = 'Dashboard';
// instantiate the barcode class
// $barcode = new Barcode;
$barcode = new \Com\Tecnick\Barcode\Barcode();
// generate a barcode
$bobj = $barcode->getBarcodeObj(
    'QRCODE,H',                     // barcode type and additional comma-separated parameters
    'https://rsudarifinachmad.riau.go.id',          // data string to encode
    -4,                             // bar width (use absolute or negative value as multiplication factor)
    -4,                             // bar height (use absolute or negative value as multiplication factor)
    'black',                        // foreground color
    array(-2, -2, -2, -2)           // padding (use absolute or negative values as multiplication factors)
)->setBackgroundColor('white')
    ->setSize(270, 270); // background color

$allTerbaru = MasterAbsensi::find()
    ->select(
        [
            "" . MasterPegawai::tableName() . ".*",
            "" . MasterAbsensi::tableName() . ".*",
            "" . MasterRiwayatPenempatan::tableName() . ".*",
            "" . MasterUnitPenempatan::tableName() . ".nama as NamaPenampatan",
            "" . MasterPegawai::tableName() . ".id_nip_nrp as NikPegawai",
        ]
    )
    ->leftJoin(MasterPegawai::tableName(), '' . MasterAbsensi::tableName() . '.id_pegawai::varchar = ' . MasterPegawai::tableName() . '.pegawai_id::varchar')
    ->leftJoin(MasterRiwayatPenempatan::tableName(), '' . MasterAbsensi::tableName() . '.nip_nik::varchar = ' . MasterRiwayatPenempatan::tableName() . '.id_nip_nrp::varchar')
    ->leftJoin(MasterUnitPenempatan::tableName(), '' . MasterUnitPenempatan::tableName() . '.kode::varchar = ' . MasterRiwayatPenempatan::tableName() . '.unit_kerja::varchar')

    ->where(['tanggal_masuk' => date("Y-m-d")])
    ->orderBy('jam_masuk DESC')->asArray()->all();
$limit5 = MasterAbsensi::find()
    ->select(
        [
            "" . MasterPegawai::tableName() . ".*",
            "" . MasterAbsensi::tableName() . ".*"
        ]
    )
    ->leftJoin(MasterPegawai::tableName(), '' . MasterAbsensi::tableName() . '.id_pegawai::varchar = ' . MasterPegawai::tableName() . '.pegawai_id::varchar')
    ->where(['tanggal_masuk' => date("Y-m-d")])
    ->orderBy('jam_masuk DESC')->limit(5)->asArray()->all();
?>
<?php Pjax::begin(['id' => 'pjax-absensi']); ?>

<style>
    .blink {
        animation: blink-animation 1s steps(5, start) infinite;
        -webkit-animation: blink-animation 1s steps(5, start) infinite;
    }

    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }

    @-webkit-keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }
</style>
<div class="row">
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

            <h4 class="header-title mt-0 m-b-30">Lima Urutan Absensi Terakhir</h4>

            <div class="inbox-widget nicescroll" style="height: 315px;">
                <?php foreach ($limit5 as  $item) { ?>


                    <a href="#" <?= $item['is_fake'] == true ? 'bg-danger text-white' : '' ?>>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="<?= Url::to('@web/img/user.png') ?>" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><?= $item['nama_lengkap'] ?></p>
                            <p class="inbox-item-text">Hadir</p>
                            <p class="inbox-item-date"><?= $item['jam_masuk'] ?> WIB</p>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card-box">
            <h4 class="header-title mt-0 m-b-30 text-center">Sistem Informasi Presensi dan Absensi</h4>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari & Tanggal</th>
                            <th>Nama</th>
                            <th>Jam Masuk [Lokasi]</th>
                            <th>Jam Pulang [Lokasi]</th>
                            <th>Penempatan</th>
                            <th>Device</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($allTerbaru as $s) { ?>
                            <tr class="<?= $s['is_fake'] === 'true' ? 'table-danger blink' : '' ?>">
                                <td><?= $no ?></td>
                                <td><?= Helper::hari_ini(date('D', strtotime($s['tanggal_masuk']))) .  " , " .  Helper::tgl_indo($s['tanggal_masuk']) ?></td>
                                <td><?= $s['nama_lengkap'] . " (" . $s['NikPegawai'] . ") " ?></td>
                                <td><?= $s['jam_masuk'] . " WIB" ?> </td>
                                <td><?= $s['jam_keluar'] . " WIB" ?> </td>
                                <td><?= empty($s['NamaPenampatan']) ? 'Belum Ada Penempatan' : $s['NamaPenampatan'] ?></td>
                                <td><?= $s['dev'] ?></td>
                            </tr>
                            <?php $no++; ?>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php Pjax::end(); ?>


<?php $this->registerJs($this->render('dashboard.js'), View::POS_END) ?>