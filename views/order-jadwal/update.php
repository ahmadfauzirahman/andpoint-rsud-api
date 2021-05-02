<?php

use app\models\JadwalSift;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OrderJadwal */

$this->title = 'Update Order Jadwal: ' . $model->sub->nama;
$this->params['breadcrumbs'][] = ['label' => 'Order Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sub->nama, 'url' => ['view', 'id' => $model->id_order_jadwal]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-jadwal-update">

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 20px">
            <div class="card">
                <div class="card-body">

                    <?php
                    $check = JadwalSift::findOne(['id_order' => $model->id_order_jadwal]);
                    if (is_null($check)) {
                    ?><a href="<?= Url::to(['order-jadwal/generate', 'id' => $model->id_order_jadwal, 'unit' => $model->unit]) ?>" class="btn btn-success card-title text-white btn-rounded">Generator Jadwal</a>
                    <?php } ?>
                    <a href="<?= Url::to(['laporan/print-cetak-jadwal', 'id' => $model->id_order_jadwal, 'unit' => $model->unit]) ?>" class="btn btn-outline-danger card-title btn-rounded">Print Jadwal</a>
                    <?= $this->render('_form-jadwal', [
                        'model' => $model,
                        'jadwal' => $jadwal,
                        'tanggal' => $tanggal
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>