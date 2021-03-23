<?php

/* @var $this yii\web\View */

use app\components\Helper;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveField;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

$this->title = 'Laporan Rekap';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">

            <div class="master-absensi-search">
                <?php $form = ActiveForm::begin([
                    'action' => ['laporan/laporan-rekap'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>

                <?= $form->field($searchModel, 'tanggal_masuk', [
                    'addon' => ['prepend' => ['content' => '<i class="fas fa-calendar-alt"></i>']],
                    'options' => ['class' => 'drp-container form-group']
                ])->widget(DateRangePicker::classname(), [
                    'useWithAddon' => true,
                    'options' => [
                        'placeholder' => 'Pilih...',
                        // 'allowClear' => true,
                    ],
                    'convertFormat' => true,

                    'pluginOptions' => [
                        'opens' => 'right',
                        'locale' => [
                            'format' => 'Y-m-d'
                        ],
                    ]
                ]);
                ?>

                <?php // echo $form->field($model, 'tanggal_masuk') 
                ?>

                <?php // echo $form->field($model, 'lat') 
                ?>

                <?php // echo $form->field($model, 'long') 
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-body">

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id_tb_absensi',
                            // 'id_pegawai',
                            'nip_nik',
                            [
                                'attribute'=>'namaPegawai',
                                'value' =>  function($model){
                                    return $model->pegawai->nama_lengkap;
                                }
                            ],

                            'jam_masuk',
                            'jam_keluar',
                            'tanggal_masuk:date',
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Helper::StatusMasuk($model->status);
                                }
                            ]
                            // 'lat',
                            // 'long',

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
        </div>

    </div>
</div>