<?php

// use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pengumuman */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="row">
            <div class="col-lg-12">
                <div class="card card-body">
				
<div class="pengumuman-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php $unit = file_get_contents(Url::to(['pengumuman/get-unit-penempatan'], true)); ?>
	<?php //$debitur = '{"1012":"Umum","1210":"BPJS Kesehatan","1211":"BPJS Ketenagakerjaan","1410":"Inhealth","1110":"Pekanbaru - Jamkesda","1111":"Kuansing - Jamkesda","1112":"Rokan Hilir - Jamkesda","1113":"Indragiri Hulu - Jamkesda"}'; ?>

	<?= $form->field($model, 'to')->widget(Select2::className(), [
		// 'data' => ArrayHelper::map($dokter, 'KODE', 'NAMA'),
		// 'data' => ["123"=>"asds", "21312"=>"zxcv"],
		'data' => json_decode($unit),
		'options' => [
			'placeholder' => "-Seluruh Unit-",
			$model->isNewRecord ? ['class' => 'form-control unit', 'placeholder' => ''] : ['class' => 'form-control']
			]
	]);
	?>
    <?= $form->field($model, 'title')->textarea(['rows' => 1, 'placeholder' => 'Judul Pengumuman']) ?>
    <?php $form->field($model, 'kategori')->textInput() ?>

	<?= $form->field($model, 'isi')->widget(\yii\redactor\widgets\Redactor::className()) ?>

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
	</div>
	</div>
	</div>