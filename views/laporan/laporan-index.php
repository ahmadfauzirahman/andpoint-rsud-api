<?php

/* @var $this yii\web\View */

use app\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Laporan Rekap';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width='5%'>No</th>
                            <th style="text-align: center;">Nama</th>
                            <th style="text-align: center;">Nip</th>
                            <th style="text-align: center;">Kehadiran</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($model as $itemAbsen) {
                            $pegawai = Helper::GetIdentitasPegawai($itemAbsen->nip_nik);
                        ?>

                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $itemAbsen->nip_nik ?></td>
                                <td><?= $pegawai['nama_lengkap'] ?></td>
                                <td style="text-align: center;"><?= Helper::HitungHariKerja($itemAbsen->nip_nik) ?> Hari</td>
                                <td style="text-align: center;"><a target="_blank" href="<?= Url::to(['laporan/cek-detail', 'id' => $itemAbsen->nip_nik]) ?>" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">Lihat Detail</a></td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>