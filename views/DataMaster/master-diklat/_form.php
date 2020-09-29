<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kepegawaian\Master\MasterDiklat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-diklat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_diklat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
