<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Kepegawaian\ModelSearch\MasterPegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pegawai';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-pegawai-index">
    <div class="card-box table-responsive">

        <p class="text-muted font-14 m-b-30">
            <?= Html::a('Tambah Master Pegawai <span class="fa fa-plus"></span>', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(['enablePushState' => false]); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-sm table-bordered table-hover table-list-item'
                ],
                // 'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'pegawai_id',
                    'id_nip_nrp',
                    'nama_lengkap',
                    'gelar_sarjana_depan',
                    'gelar_sarjana_belakang',
                    //'tempat_lahir',
                    //'tanggal_lahir',
                    'jenis_kelamin',
                    [
                        'attribute' => 'desa_kelurahan',
                        'value' => 'desa.nama'
                    ],
                    [
                        'attribute' => 'kecamatan',
                        'value' => 'kec.nama'
                    ],
                    //'status_perkawinan',
                    // 'agama',
                    //'alamat_tempat_tinggal',
                    //'rt_tempat_tinggal',
                    //'rw_tempat_tinggal',
                    //'desa_kelurahan',
                    //'kecamatan',
                    //'kabupaten_kota',
                    //'provinsi',
                    //'kode_pos',
                    //'no_telepon_1',
                    //'no_telepon_2',
                    //'golongan_darah',
                    //'status_kepegawaian_id',
                    //'jenis_kepegawaian_id',
                    //'nomor_karpeg',
                    //'nomor_kartu_askes',
                    //'nomor_kartu_taspen',
                    //'nomor_karis_karsu',
                    //'npwp',
                    //'nomor_ktp',
                    //'nota_persetujuan_bkn_nomor_cpns',
                    //'nota_persetujuan_bkn_tanggal_cpns',
                    //'pejabat_yang_menetapkan_cpns',
                    //'sk_cpns_nomor_cpns',
                    //'sk_cpns_tanggal_cpns',
                    //'kode_pangkat_cpns',
                    //'tmt_cpns',
                    //'masa_kerja_tahun_cpns',
                    //'masa_kerja_bulan_cpns',
                    //'pejabat_yang_menetapkan_pns',
                    //'sk_nomor_pns',
                    //'sk_tanggal_pns',
                    //'kode_pangkat_pns',
                    //'tmt_pns',
                    //'sumpah_janji_pns',
                    //'masa_kerja_tahun_pns',
                    //'masa_kerja_bulan_pns',
                    //'tinggi_keterangan_badan',
                    //'berat_badan_keterangan_badan',
                    //'rambut_keterangan_badan',
                    //'bentuk_muka_keterangan_badan',
                    //'warna_kulit_keterangan_badan',
                    //'ciri_ciri_khas_keterangan_badan',
                    //'cacat_tubuh_keterangan_badan',
                    //'kegemaran_1',
                    //'kegemaran_2',
                    //'kegemaran_3',
                    //'photo',
                    //'status_aktif_pegawai',
                    //'kode_kategori_pegawai',
                    //'kode_jenis_kepegawaian_rl4',
                    //'masa_kerja_honorer',
                    // 'tipe_user',

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
</div>