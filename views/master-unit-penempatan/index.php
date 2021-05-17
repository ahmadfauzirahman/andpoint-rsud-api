<?php

use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Kepegawaian\MasterUnitPenempatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Unit Penempatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-unit-penempatan-index">


    <div class="card card-box">

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'bsVersion' => '4.x',
            'hover' => true,
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            // 'pjax' => true,
            'striped' => false,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    // 'width' => '50px',
                ],

                // 'kode',
                [
                    'attribute' => 'nama',
                    'width' => '350px',
                    // 'group' => true,  // enable grouping
                ],
                [
                    'attribute' => 'unit_rumpun',
                    'hAlign' => 'center',

                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(MasterUnitPenempatan::find()->orderBy('kode ASC')->asArray()->all(), 'kode', 'nama'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'format' => 'raw',
                    'filterInputOptions' => ['placeholder' => 'Pilih Rumpun'],
                    'value' => function ($model) {
                        $a = MasterUnitPenempatan::findOne(['kode' => $model->unit_rumpun])['nama'];

                        return   Html::a($a, ['view-penempatan', 'id' => $model->unit_rumpun], [
                            'data' => [
                                // 'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                                'target' => '_blank',
                                'data-pjax' => '0'
                            ],
                        ]);
                        // return $model->unit_rumpun;
                    },
                    'group' => true,  // enable grouping,
                    'pageSummary' => true,
                    // 'groupedRow' => true,   
                    // 'subGroupOf' => 1 // supplier column index is the parent group,                 // move grouped column to a single grouped row

                ],
                // 'kode_unitsub_maping_simrs',

                // [
                //     'class' => 'app\components\ActionColumn',
                // ],
            ],
            'pager' => [
                'class' => 'app\components\GridPager',
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>

</div>