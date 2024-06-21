<?php

namespace app\controllers;

use app\components\GoogleCalendar;
use app\components\HelperHari as ComponentsHelperHari;
use app\models\Absensi\MasterAbsensi;
use app\models\Absensi\ModelSearch\MasterAbsensiSearch;
use app\models\Absensi\OrderJadwal;
use app\models\JadwalSift;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\MasterPegawai;
use HelperHari;
use Mpdf\Mpdf;
use Yii;
use yii\helpers\Url;

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

    public function actionLaporanRekapEselon()
    {

        // echo '<pre>';
        // var_dump($model);
        // exit;

        $query = Yii::$app->db->createCommand("
       WITH data_eselon AS (select
       a.nama_lengkap ,
       a.id_nip_nrp ,
       (
       select
     --    b.kode_jabatan,
         b.eselon_id 
       from
       pegawai.tb_riwayat_jabatan b
       where
         b.nip = a.id_nip_nrp
       order by
         b.sk_pelantikan_tanggal desc
       limit 1) as eselon
     from
       pegawai.tb_pegawai a
     where
       a.status_kepegawaian_id = '121'
       and a.status_aktif_pegawai = '1'
     order by
       eselon asc)
       
     SELECT * FROM data_eselon WHERE eselon != 99 and eselon is not null;         
       ")->queryAll();


        $queryCount = Yii::$app->db->createCommand("
       WITH data_eselon AS (select
       a.nama_lengkap ,
       a.id_nip_nrp ,
       (
       select
     --    b.kode_jabatan,
         b.eselon_id 
       from
       pegawai.tb_riwayat_jabatan b
       where
         b.nip = a.id_nip_nrp
       order by
         b.sk_pelantikan_tanggal desc
       limit 1) as eselon
     from
       pegawai.tb_pegawai a
     where
       a.status_kepegawaian_id = '121'
       and a.status_aktif_pegawai = '1'
     order by
       eselon asc)
       
     SELECT count(1) FROM data_eselon WHERE eselon != 99 and eselon is not null;
       ")->queryAll();
        $berapaLembar = $queryCount[0]['count'];
        // var_dump($queryCount[0]['count']);
        // exit();
        $fontsize = 12;
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'default_font' => 'sanserif',
            'default_font_size' => $fontsize,
            //'format'=> (($size_orientation=='LEGAL-L')?[330,215]:[215,330]),
        ]);

        $mpdf->AddPage('L');
        $mpdf->WriteHTML($this->renderPartial('laporan-eselon', [
            'queryAll' => $query,
            'berapaLembar' => $berapaLembar
            // 'model' => $model
            // 'laporan' => $laporan,
        ]));

        $mpdf->Output('Laporan Rekap Absensi Eselon.pdf', 'I');

        exit;
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


    public function actionPrintCetakJadwal($id, $unit)
    {

        $jadwalSiftDetail = JadwalSift::findOne(['id_order' => $id]);

        $tanggal = cal_days_in_month(CAL_GREGORIAN, $jadwalSiftDetail->bln, $jadwalSiftDetail->thn);

        $jadwalSift = JadwalSift::find()
            ->alias('jd')
            ->select([
                'mg.nama_lengkap',
                'jd.*',
                'oj.*'
            ])
            ->leftJoin(OrderJadwal::tableName() . " as oj", 'oj.id_order_jadwal::varchar=jd.id_order::varchar')
            ->leftJoin(MasterPegawai::tableName() . " as mg", 'mg.id_nip_nrp=jd.identitas_pegawai')
            ->where(['id_order' => $id])
            ->asArray()
            ->all();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
        ]);
        $mpdf->AddPage('L'); // Adds a new page in Landscape orientation
        $mpdf->SetTitle('JADWAL DINAS RSUD');
        $mpdf->SetWatermarkImage(Url::to('@web/img/rsud.png'));
        $mpdf->showWatermarkImage = true;
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($this->renderPartial('laporan-cetak-jadwal', [
            'mpdf' => $mpdf,
            'jadwalSift' => $jadwalSift,
            'tanggal' => $tanggal,
        ]));

        $mpdf->Output('Jadwal Dinas RSUD.pdf', 'I');
        exit;
        // echo '<pre>';
        // var_dump($jadwalSift);
        // exit;
    }
}
