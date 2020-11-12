<?php

use app\components\Helper;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi\Master\MasterJadwal */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="master-jadwal-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'kode_unit_kerja')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Helper::UnitKerja(), 'kode', 'nama'),
        'theme' => Select2::THEME_KRAJEE, // this is the default if theme is not set
        'options' => [
            'placeholder' => 'Pilih Unit',
            'multiple' => true
        ],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]); ?>
    <?= $form->field($model, 'senin_rabu_masuk')->widget(TimePicker::classname(), [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ]); ?>

    <?= $form->field($model, 'kamis')->widget(TimePicker::classname(), [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ]); ?>

    <?= $form->field($model, 'jumat')->widget(TimePicker::classname(), [
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ]); ?>

    <?= $form->field($model, 'status_pegawai')->dropDownList(Helper::StatusPegawai, ['prompt' => 'Status Pegawai']) ?>
    <?= $form->field($model, 'status_jadwal')->dropDownList(Helper::Jadwal, ['prompt' => 'Status Absensi']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>