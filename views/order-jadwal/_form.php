<?php

use app\components\Helper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\OrderJadwal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-jadwal-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'identitas')->textInput(['value' => Yii::$app->user->identity->nama, 'readonly' => true])->label("Pembuat Jadwal") ?>
        </div>
    </div>

    <?= $form->field($model, 'jadwal')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Pilih Tgl Jadwal Sift'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'mm-yyyy'
        ]
    ]); ?>
    <?= $form->field($model, 'unit')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Helper::UnitKerja(), 'kode', 'nama'),
        'theme' => Select2::THEME_KRAJEE, // this is the default if theme is not set
        'options' => [
            'placeholder' => 'Pilih Unit',
        ],
    ]); ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6, 'placeholder' => 'Keterangan Boleh Kosong']) ?>


    <?php $form->field($model, 'created_at')->textInput() ?>

    <?php $form->field($model, 'created_by')->textInput() ?>

    <div class="form-group float-right">
        <?php if ($model->isNewRecord) { ?>
            <?= Html::submitButton('Buat Jadwal <span class="fa fa-plus"></span>', ['class' => 'btn btn-success btn-rounded btn-trans']) ?>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>