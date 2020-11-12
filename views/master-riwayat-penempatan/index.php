<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Kepegawaian\MasterRiwayatPenempatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Riwayat Penempatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-riwayat-penempatan-index">

    <div class="card card-box">

    <?php Pjax::begin(['enablePushState' => false]); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'id_nip_nrp',
                'nota_dinas',
                'tanggal:date',
                'atasan_langsung',
                'penempatan',
                'sdm_rumpun',
                'sdm_sub_rumpun',
                //'sdm_jenis',
                //'dokumen',
                'unit_kerja',

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