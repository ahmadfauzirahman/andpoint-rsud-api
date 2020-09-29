<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\Master\MasterAgama */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-agama-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
