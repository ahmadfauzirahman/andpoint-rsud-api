<?php

namespace app\controllers\Api;

use app\components\Helper;
use app\models\Absensi\MasterAbsensi;
use app\models\Kepegawaian\MasterPegawai;
use PHPUnit\TextUI\Help;
use Yii;

class AbsenController extends ControllerBase
{
    public function actionAmbilDataAbsen()
    {
        $p = Yii::$app->request;
        if ($p->isPost) {
            $post = $p->post();

            $kodeAkun = $post['kode'];
            $data = MasterAbsensi::find()->where(['nip_nik' => $kodeAkun])->orderBy('id_tb_absensi DESC')->all();

            foreach ($data as $itemAbsen) {
                $result[] = [
                    'IdAbsensi' => $itemAbsen->id_tb_absensi,
                    'idPegawai' => $itemAbsen->id_pegawai,
                    'Nip' => $itemAbsen->nip_nik,
                    'TanggalMasuk' => Helper::tgl_indo($itemAbsen->tanggal_masuk),
                    'Hari' => Helper::hari_ini(date('D', strtotime($itemAbsen->tanggal_masuk))),
                    'StatusMasuk' => Helper::StatusMasuk($itemAbsen->status),
                    'lat' => $itemAbsen->lat,
                    'long' => $itemAbsen->long,
                    'jamMasuk' => $itemAbsen->jam_masuk
                ];
            }

            return $this->writeResponse(true, 'Berhasil Melihat Log History Absen', $result);
        }

        // return $this->writeResponse(false, 'Opps', []);
    }
}
