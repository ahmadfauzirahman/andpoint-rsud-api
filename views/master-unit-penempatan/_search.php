<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\MasterUnitPenempatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-unit-penempatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'unit_rumpun') ?>

    <?= $form->field($model, 'kode_unitsub_maping_simrs') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
