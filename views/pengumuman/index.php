<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PengumumanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengumuman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengumuman-index">
    <div class="card-box table-responsive">

        <p>
            <?= Html::a('Tambah Pengumuman', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id_pengumuman',
                'to',
                'title:ntext',
                'isi:html',
                [
                    'attribute' => 'file',
                    'format' => 'raw',
                    'value' =>  function ($model) {
                        if (empty($model->file)) {
                            return  "File Tidak Ada";
                        } else {
                            return  "<a href='" . Url::To('@web/file-pengumuman/' . $model->file) . "' target='_blank'>Lihat File</a>";
                        }
                    }
                ],
                // 'author',
                //'created_at',
                //'update_by',
                //'update_at',
                'status',
                //'kategori',

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
</div>