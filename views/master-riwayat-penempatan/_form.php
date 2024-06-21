<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\MasterRiwayatPenempatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-riwayat-penempatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_nip_nrp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nota_dinas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'atasan_langsung')->textInput() ?>

    <?= $form->field($model, 'penempatan')->textInput() ?>

    <?= $form->field($model, 'sdm_rumpun')->textInput() ?>

    <?= $form->field($model, 'sdm_sub_rumpun')->textInput() ?>

    <?= $form->field($model, 'sdm_jenis')->textInput() ?>

    <?= $form->field($model, 'dokumen')->textInput() ?>

    <?= $form->field($model, 'unit_kerja')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
