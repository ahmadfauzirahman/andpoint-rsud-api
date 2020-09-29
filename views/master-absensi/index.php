<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Absensi\ModelSearch\MasterAbsensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Absensi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-absensi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Master Absensi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_tb_absensi',
            // 'id_pegawai',
            'nip_nik',
            'jam_masuk',
            'jam_keluar',
            'tanggal_masuk',
            'lat',
            'long',

            [
                'class' => 'app\components\ActionColumn',
            ],
        ],
        'pager' => [
            'class' => 'app\components\GridPager',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>