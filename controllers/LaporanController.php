<?php

namespace app\controllers;

use app\components\GoogleCalendar;
use app\components\HelperHari as ComponentsHelperHari;
use app\models\Absensi\MasterAbsensi;
use app\models\Absensi\ModelSearch\MasterAbsensiSearch;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\MasterPegawai;
use HelperHari;
use Mpdf\Mpdf;
use Yii;

class LaporanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLaporanRekap()
    {
        $modelUnit = MasterUnitPenempatan::find()->all();

        $searchModel = new MasterAbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('laporan-index', [
            'modelUnit' => $modelUnit,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLaporanCetakPdf()
    {

        // $o

        $model = MasterAbsensi::find()
            ->select(['nip_nik'])
            ->where(['BETWEEN', 'tanggal_masuk', '2021-01-04', '2021-01-30'])
            ->groupBy(['nip_nik'])
            ->all();
        // echo '<pre>';
        // var_dump($model);
        // exit;
        $fontsize = 12;
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'default_font' => 'sanserif',
            'default_font_size' => $fontsize,
            //'format'=> (($size_orientation=='LEGAL-L')?[330,215]:[215,330]),
        ]);

        $mpdf->AddPage('L');
        $mpdf->WriteHTML($this->renderPartial('laporan-cetak', [
            // 'datamcu' => $datamcu,
            'model' => $model
            // 'laporan' => $laporan,
        ]));

        $mpdf->Output('Pemeriksaan Fisik.pdf', 'I');

        exit;
    }

    public function actionCekDetail($id)
    {

        $googleCalander = new ComponentsHelperHari();
        $d = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $hariLiburNasional = $googleCalander->cekNationalFreeDay();

        $hari_kerja = $googleCalander->getHariKerja($d, 0);
        $pegawai = MasterPegawai::find()->where(['id_nip_nrp' => $id])->one();
        $data_absen = MasterAbsensi::find()->where(['nip_nik' => $id])->andWhere(['between', 'tanggal_masuk', '2021-02-01', '2021-02-28'])->all();
        return $this->render('check-detail', [

            'pegawai' => $pegawai,
            'data_absen' => $data_absen,
            'HariLibur' => $hariLiburNasional
        ]);
    }
}
