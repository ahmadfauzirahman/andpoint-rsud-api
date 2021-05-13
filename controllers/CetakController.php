<?php

namespace app\controllers;

use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\Master\MasterUnitSubPenempatan;
use app\models\OrderJadwal;
use yii\helpers\Json;
use yii\httpclient\Client;


class CetakController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEdp()
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            // 'format' => array(210, 140),
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 10,
            'margin_bottom' => 5,
            'margin_header' => 2,
            'margin_footer' => 2
        ]);
        // $mpdf->use_kwt = true;
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->SetTitle('Cetak Absensi EDP');
        $mpdf->AddPage('L');

        // return $this->render('cetak-edp');

        // Data

        $client = new Client();
        $orangEdp = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://sip.simrs.aa/api/simpeg')
            ->setData([
                'token' => 'DataPegawaiRSUD44',
                'jenis' => 'programmer', // jaringan
                // 'jenis' => 'jaringan', // jaringan
            ])
            ->send();
        $kepalaEdp = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://sip.simrs.aa/api/simpeg')
            ->setData([
                'token' => 'DataPegawaiRSUD44',
                'jenis' => 'atasan',
                'search' => 37,
            ])
            ->send();

        if ($orangEdp->isOk) {
            $org_edp = $orangEdp->data['result'];

            $org_edp =
                [
                    'con' => true,
                    'info' => "success",
                    'num' => 9,
                    'result' => [
                        [
                            'id' => "1403092308940009",
                            'nama' => "Dicky Ermawan Sukwana, S.T",
                            'jabatan' => "SOFTWARE ENGINEER",
                            'penempatan' => "ELECTRONIC DATA PROCESSING",
                            'bulan' => "03",
                            'tahun' => "2021",
                            'absensi'  => [
                                1 => [
                                    'jam_masuk' => "07:59",
                                    'jam_pulang' => "15:30",
                                ],
                                2 => [
                                    'jam_masuk' => "07:30",
                                    'jam_pulang' => "17:30",
                                ],
                                5 => [
                                    'jam_masuk' => "08:18",
                                    'jam_pulang' => "16:20",
                                ],
                            ],
                        ],
                        [
                            'id' => "1403092308940008",
                            'nama' => "Afdhal",
                            'jabatan' => "SOFTWARE ENGINEER",
                            'penempatan' => "ELECTRONIC DATA PROCESSING",
                            'bulan' => "03",
                            'tahun' => "2021",
                            'absensi'  => [
                                1 => [
                                    'jam_masuk' => "08:30",
                                    'jam_pulang' => "16:45",
                                ],
                                2 => [
                                    'jam_masuk' => "07:30",
                                    'jam_pulang' => "17:30",
                                ],
                            ],
                        ],
                    ]
                ];
            $org_edp = $org_edp['result'];
            // echo "<pre>";
            // print_r($org_edp);
            // echo "</pre>";
            // die;
        } else {
            $org_edp = null;
        }
        if ($kepalaEdp->isOk) {
            $kepala_edp = $kepalaEdp->data['result'][0];
        } else {
            $kepala_edp = null;
        }

        $bulanAbsen = '03-2021';

        $query_date = date('Y-m-d', strtotime('01-' . $bulanAbsen));
        $periode = \Yii::$app->formatter->asDate($query_date, 'php:F Y');

        // First day of the month.
        $startDate = date('Y-m-01', strtotime($query_date));
        // Last day of the month.
        $endDate = date('Y-m-t', strtotime($query_date));

        $startDay = (int) date('d', strtotime($startDate));
        $endDay = (int) date('d', strtotime($endDate));

        $berapaLembar = $endDay / 6;
        $berapaLembar = is_float($berapaLembar) ? (floor($berapaLembar) + 1) : floor($berapaLembar);

        $startDayTanggal = $startDay;
        $startDayPukul = $startDay;
        $startDayTtd = $startDay;

        $mpdf->WriteHTML($this->renderPartial('cetak-edp', [
            'org_edp' => $org_edp,
            'kepala_edp' => $kepala_edp,
            'berapaLembar' => $berapaLembar,
            'periode' => $periode,
            'startDay' => $startDay,
            'endDay' => $endDay,
            'startDayTanggal' => $startDayTanggal,
            'startDayPukul' => $startDayPukul,
            'startDayTtd' => $startDayTtd,
            'endDate' => $endDate,
        ]));
        // $mpdf->SetJS('this.print(false);');
        // $mpdf->Output('Cetak Struk Penjualan ' . $model['no_penjualan'] . '.pdf', 'F');
        $mpdf->Output('Cetak Absensi EDP.pdf', 'I');
        exit;
    }

    public function actionJadwal($id = null, $unit = null)
    {
        $id_unit = $unit;

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            // 'format' => array(210, 140),
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 10,
            'margin_bottom' => 5,
            'margin_header' => 2,
            'margin_footer' => 2
        ]);
        // $mpdf->use_kwt = true;
        $mpdf->shrink_tables_to_fit = 1;

        $orderJadwal = OrderJadwal::find()
            // ->leftJoin('pegawai.dm_unit_sub_penempatan', 'pegawai.dm_unit_sub_penempatan.kode_rumpun=dm_unit_penempatan.kode')
            ->where([
                'tb_order_jadwal.unit' => $id_unit
            ])
            ->one();

        $unitTerkait = MasterUnitSubPenempatan::find()
            ->alias('msb')->select([
                'mup.nama',
                'mup.kode'
            ])
            ->leftJoin(MasterUnitPenempatan::tableName() . " as mup", 'msb.kode_rumpun=mup.kode')
            ->where(['msb.kode' => $unit])->one();
        // var_dump($unitTerkait);
        // exit;

        $mpdf->SetTitle('Cetak Jadwal - ' . $orderJadwal->sub->nama);
        $mpdf->AddPage('L');
        // echo "<pre>";
        // print_r($orderJadwal->jadwalsift);
        // echo "</pre>";
        // die;


        $client = new Client();
        $kepalaEdp = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://sip.simrs.aa/api/simpeg')
            ->setData([
                'token' => 'DataPegawaiRSUD44',
                'jenis' => 'atasan',
                'search' => $unitTerkait->kode,
            ])
            ->send();
         
        if ($kepalaEdp->isOk) {
            $kepala_edp = $kepalaEdp->data['result'][0];
        } else {
            $kepala_edp = null;
        }

        // echo '<pre>';
        // var_dump($kepala_edp);
        // exit;

        $bulanAbsen = $orderJadwal->jadwal;

        $query_date = date('Y-m-d', strtotime('01-' . $bulanAbsen));
        $periode = \Yii::$app->formatter->asDate($query_date, 'php:F Y');

        // First day of the month.
        $startDate = date('Y-m-01', strtotime($query_date));
        // Last day of the month.
        $endDate = date('Y-m-t', strtotime($query_date));

        $startDay = (int) date('d', strtotime($startDate));
        $endDay = (int) date('d', strtotime($endDate));

        $berapaLembar = $endDay / 6;
        $berapaLembar = is_float($berapaLembar) ? (floor($berapaLembar) + 1) : floor($berapaLembar);

        $startDayTanggal = $startDay;
        $startDayPukul = $startDay;
        $startDayTtd = $startDay;

        $mpdf->WriteHTML($this->renderPartial('cetak-jadwal', [
            // 'org_edp' => $org_edp,
            'kepala_edp' => $kepala_edp,
            'berapaLembar' => $berapaLembar,
            'periode' => $periode,
            'startDay' => $startDay,
            'endDay' => $endDay,
            'startDayTanggal' => $startDayTanggal,
            'startDayPukul' => $startDayPukul,
            'startDayTtd' => $startDayTtd,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'jadwalSift' => $orderJadwal
                ->getJadwalsift()
                ->joinWith(['pegawai'])
                ->orderBy([
                    'nama_lengkap' => SORT_ASC
                ])
                ->all(),
            'orderJadwal' => $orderJadwal,
            'unitTerkait' => $unitTerkait
        ]));
        // $mpdf->SetJS('this.print(false);');
        // $mpdf->Output('Cetak Struk Penjualan ' . $model['no_penjualan'] . '.pdf', 'F');
        $mpdf->Output('Cetak Absensi EDP.pdf', 'I');
        exit;
    }
}
