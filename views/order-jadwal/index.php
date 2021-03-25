<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderJadwalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Jadwal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-jadwal-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">

                <p>
                    <?= Html::a('Tambah Order Jadwal', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-sm table-bordered table-hover table-list-item'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id_order_jadwal',
                        [
                            'attribute' => 'identitas',
                            'value' => 'pegawai.nama_lengkap'
                        ],
                        'jadwal',
                        'keterangan:ntext',
                        [
                            'attribute' => 'unit',
                            'value' => 'sub.nama'
                        ],
                        //'created_at',
                        //'created_by',

                        [
                            'class' => 'app\components\ActionColumn',
                        ],
                    ],
                    'pager' => [
                        'class' => 'app\components\GridPager',
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>