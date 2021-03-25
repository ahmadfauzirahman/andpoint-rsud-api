<?php

namespace app\components;

use app\models\Absensi\MasterAbsensi;
use app\models\Absensi\MasterJadwal;
use app\models\JadwalSift;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\Master\MasterUnitSubPenempatan;
use app\models\Kepegawaian\MasterPegawai;

class Helper
{

    const StatusAbsensi = [
        'h' => 'Hadir',
        'a' => 'Alfa',
        'i' => 'Izin',
        's' => 'Sakit'
    ];

    const StatusPegawai = [
        'PEGAWAI NON SHIFF' => 'PEGAWAI NON SHIFF',
        'PEGAWAI SHIFF' => 'PEGAWAI SHIFF',
        'DOKTER ON SITE' => 'DOKTER ON SITE'
    ];

    const Jadwal = [
        'Masuk' => 'Masuk',
        'Pulang' => 'Pulang'
    ];

    static function StatusMasuk($r)
    {
        switch ($r) {
            case "h":
                return "Hadir";
                break;
            case 'a':
                return 'Alfa';
                break;
            case 'i':
                return 'Izin';
                break;
            case 's':
                return 'Sakit';
                break;
        }
    }

    // static function GetData

    static function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public static function radioList($index, $label, $name, $checked, $value, $model)
    {
        $id = str_replace(['[', ']'], '_', $name) . $index;
        return \yii\helpers\Html::radio(
            $name,
            $checked,
            [
                'value' => $value,
                'label' => $label,
                'id' => $id
            ]
        );
    }

    static function hari_ini($d)
    {
        $hari = $d;

        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }

        return $hari_ini;
    }

    static function UnitKerja()
    {
        $master = MasterUnitSubPenempatan::find()->orderBy('nama DESC')->all();
        return $master;
    }


    static function GetIdentitasPegawai($nip)
    {
        $models = MasterPegawai::findOne(['id_nip_nrp' => $nip]);
        return $models;
    }

    static function HitungHariKerja($nip)
    {
        $hariKerja = MasterAbsensi::find()->where(['nip_nik' => $nip])
            ->andWhere(['BETWEEN', 'tanggal_masuk', '2021-01-04', '2021-01-30'])
            ->all();

        $jumlahHariKerja = count($hariKerja);
        return $jumlahHariKerja;
    }

    static function menghitung_selisih($waktu_awal, $waktu_akhir)
    {
        $awl = strtotime($waktu_awal);
        $akh = strtotime($waktu_akhir); // bisa juga waktu sekarang now()
        //menghitung selisih dengan hasil detik
        $diff = $awl - $akh;

        //membagi detik menjadi jam
        $jam = floor($diff / (60 * 60));

        //membagi sisa detik setelah dikurangi $jam menjadi menit
        $menit = $diff - $jam * (60 * 60);

        return $jam . " Jam dan " . floor($menit / 60) . " Menit";
    }

    static function menghitung_jumlah_ovt($waktu_jam_pulang, $waktu_normal)
    {
        $awl = strtotime($waktu_jam_pulang);
        $akh = strtotime($waktu_normal); // bisa juga waktu sekarang now()
        //menghitung selisih dengan hasil detik
        $diff = $awl - $akh;

        //membagi detik menjadi jam
        $jam = floor($diff / (60 * 60));

        //membagi sisa detik setelah dikurangi $jam menjadi menit
        $menit = $diff - $jam * (60 * 60);

        if ($jam == 0) {
            return floor($menit / 60);
        } else {

            return $jam . " Jam dan " . floor($menit / 60) . " Menit";
        }
    }

    static function menghitung_jumlah_cpt_pulang($waktu_jam_pulang, $waktu_normal)
    {
        $awl = strtotime($waktu_normal);
        $akh = strtotime($waktu_jam_pulang); // bisa juga waktu sekarang now()
        //menghitung selisih dengan hasil detik
        $diff = $awl - $akh;

        //membagi detik menjadi jam
        $jam = floor($diff / (60 * 60));

        //membagi sisa detik setelah dikurangi $jam menjadi menit
        $menit = $diff - $jam * (60 * 60);

        if ($jam == -1) {
            return floor($menit / 60);
        } else {

            return floor($menit / 60);
        }
    }

    static function menghitung_jumlah_tlt_datang($waktu_jam_pulang, $waktu_normal)
    {
        $awl = strtotime($waktu_jam_pulang);
        $akh = strtotime($waktu_normal); // bisa juga waktu sekarang now()
        //menghitung selisih dengan hasil detik
        $diff = $awl - $akh;

        //membagi detik menjadi jam
        $jam = floor($diff / (60 * 60));

        //membagi sisa detik setelah dikurangi $jam menjadi menit
        $menit = $diff - $jam * (60 * 60);

        if ($jam == -1) {
            return floor($menit / 60);
        } else {

            return floor($menit / 60);
        }
    }


    public static function batchInsert($tableName, $columnNameArray, $bulkInsertArray)
    {
        // \Yii::$app->db->createCommand()->truncateTable($tableName)->execute();
        $insertCount = \Yii::$app->db->createCommand()
            ->batchInsert($tableName, $columnNameArray, $bulkInsertArray)
            ->execute();
        return $insertCount;
    }

    static function keteranganJadwal()
    {
        $model = MasterJadwal::find()->all();
        return $model;
    }

}
