<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi\MasterAbsensi */

$this->title = $model->nip_nik;
$this->params['breadcrumbs'][] = ['label' => 'Master Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-absensi-view">

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id_tb_absensi], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_tb_absensi], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id_tb_absensi',
                        'id_pegawai',
                        'nip_nik',
                        'jam_masuk',
                        'jam_keluar',
                        'tanggal_masuk',
                        'lat',
                        'long',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

</div>