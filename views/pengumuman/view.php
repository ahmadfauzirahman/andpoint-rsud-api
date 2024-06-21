<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pengumuman */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pengumuman', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pengumuman-view">

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id_pengumuman], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_pengumuman], [
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
                        // 'id_pengumuman',
                        // 'unit.nama',
						[
							'label' => 'Tujuan Instansi',
							// 'value' => 'unit.nama',
							'value' => function ($model) {
								if (empty($model->to)) {
									return  "Seluruh unit";
								} else {
									return $model->unit->nama;
								}
							},
						],
                        'title:ntext',
                        'isi:html',
                        // [
                            // 'attribute' => 'file',
                            // 'format' => 'raw',
                            // 'value' =>  function ($model) {
                                // if (is_null($model->file)) {
                                    // return  "File Tidak Ada";
                                // } else {
                                    // return  "<a href='" . Url::To('@web/file-pengumuman/' . $model->file) . "' target='_blank'>Lihat File</a>";
                                // }
                            // }
                        // ],
                        // 'author',
                        // 'created_at',
                        // 'update_by',
                        // 'update_at',
                        'status',
                        // [
                            // 'format' => 'raw',
                            // 'attribute' => 'image_encode',
                            // 'value' => function ($model) {
                                // return "<img src='" . $model->image_encode . "'>";
                            // }
                        // ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>