<?php

use app\assets\DatePickerAsset;
use app\assets\MapAsset;
use app\assets\TimePickerAsset;
use app\components\Helper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\JsExpression;

TimePickerAsset::register($this);
DatePickerAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Absensi\MasterAbsensi */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="master-absensi-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12">
        <?= $form->field($model, 'id_pegawai')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-12">
            <?= $form->field($model, 'nip_nik')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'tanggal_masuk')->textInput(['id' => 'datepicker-autoclose', 'placeholder' => 'Entry Tanggal Masuk']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'jam_masuk')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'jam_keluar')->textInput() ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'lat')->textInput(['maxlength' => true, 'value' => '0.522063', 'readonly' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'long')->textInput(['maxlength' => true, 'value' => 'w', 'readonly' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'status')->dropDownList(Helper::StatusAbsensi, ['prompt' => 'Pilih Status Absensi']) ?>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>