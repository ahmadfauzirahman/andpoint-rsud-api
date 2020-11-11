<?php

use app\components\Helper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi\Master\MasterJadwal */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="master-jadwal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'senin_kamis_masuk')->textInput() ?>

    <?= $form->field($model, 'jumat')->textInput() ?>

    <?= $form->field($model, 'sabtu')->textInput() ?>

    <?= $form->field($model, 'status_pegawai')->dropDownList(Helper::StatusPegawai, ['prompt' => 'Status Pegawai']) ?>
    <?= $form->field($model, 'status_jadwal')->dropDownList(Helper::Jadwal, ['prompt' => 'Status Absensi']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>