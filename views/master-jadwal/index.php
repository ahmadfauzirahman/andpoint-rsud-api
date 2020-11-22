<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Absensi\Master\MasterJadwalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Jadwal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-jadwal-index">

    <div class="card card-box">
        <p>
            <?= Html::a('Tambah Master Jadwal', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'kode_unit_kerja',
                    'value' => function ($model) {
                        return $model->unit->nama;
                    }
                ],
                'senin_rabu_masuk',
                'kamis',
                'jumat',
                'status_pegawai',
                'status_jadwal',

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