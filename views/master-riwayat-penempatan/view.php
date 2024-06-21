<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\MasterRiwayatPenempatan */

$this->title = $model->id_nip_nrp;
$this->params['breadcrumbs'][] = ['label' => 'Master Riwayat Penempatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-riwayat-penempatan-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            // 'id',
            'id_nip_nrp',
            'nota_dinas',
            'tanggal:date',
            'atasan_langsung',
            'penempatan',
            'sdm_rumpun',
            'sdm_sub_rumpun',
            'sdm_jenis',
            'dokumen',
            'unit_kerja',
        ],
    ]) ?>

</div>
