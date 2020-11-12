<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\MasterRiwayatPenempatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-riwayat-penempatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_nip_nrp') ?>

    <?= $form->field($model, 'nota_dinas') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'atasan_langsung') ?>

    <?php // echo $form->field($model, 'penempatan') ?>

    <?php // echo $form->field($model, 'sdm_rumpun') ?>

    <?php // echo $form->field($model, 'sdm_sub_rumpun') ?>

    <?php // echo $form->field($model, 'sdm_jenis') ?>

    <?php // echo $form->field($model, 'dokumen') ?>

    <?php // echo $form->field($model, 'unit_kerja') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
