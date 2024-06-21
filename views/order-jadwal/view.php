<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderJadwal */

$this->title = $model->sub->nama;
$this->params['breadcrumbs'][] = ['label' => 'Order Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-jadwal-view">

    <div class="card card-body">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id_order_jadwal], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_order_jadwal], [
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
                // 'id_order_jadwal',
                [
                    'attribute' => 'identitas',
                    'value' => $model->pegawai->nama_lengkap
                ],
                'jadwal',
                'keterangan:ntext',
                [
                    'attribute' => 'unit',
                    'value' => $model->sub->nama
                ],
                'created_at:datetime',
                'created_by',
            ],
        ]) ?>
    </div>

</div>