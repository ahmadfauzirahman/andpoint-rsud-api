<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengumuman */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="pengumuman-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'to')->textInput(['placeholder' => 'Ditunjukan Kepada']) ?>
    <?= $form->field($model, 'title')->textarea(['rows' => 1, 'placeholder' => 'Judul Pengumuman']) ?>
    <?php $form->field($model, 'kategori')->textInput() ?>

    <?= $form->field($model, 'isi')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]) ?>

    <label for="">File <code>Jika Ada</code></label>
    <?php
    $data = isset($model->file) ? [
        'pluginOptions' => [
            'initialPreview' => Yii::$app->request->baseUrl . '/web/file/' . $model->file,
            'initialPreviewAsData' => true,
            'initialCaption' => $model->id_pengumuman,
        ],
    ] : [];
    ?>
    <?= $form->field($model, 'file')->widget(\kartik\file\FileInput::className(), $data)->label(false) ?>
    <?php $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'created_at')->textInput() ?>

    <?php $form->field($model, 'update_by')->textInput() ?>

    <?php $form->field($model, 'update_at')->textInput() ?>


    <?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draf' => 'Draf']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>