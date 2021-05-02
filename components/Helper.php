<?php

namespace app\components;

use app\models\Absensi\MasterAbsensi;
use app\models\Absensi\MasterJadwal;
use app\models\JadwalSift;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\Master\MasterUnitSubPenempatan;
use app\models\Kepegawaian\MasterPegawai;
use DateTime;
use Yii;

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
    static function convertToHoursMins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
    static function mengitungSelisihMenit($tanggal_masuk = null, $waktu_awal = null, $waktu_akhir =  null)
    {
        $start_date = new DateTime("$tanggal_masuk $waktu_awal");
        $since_start = $start_date->diff(new DateTime("$tanggal_masuk $waktu_akhir"));
        // echo $since_start->h . ' hours<br>';
        // echo $since_start->i . ' minutes<br>';
        // echo $since_start->s . ' seconds<br>';
        // exit;
        return [$since_start->s, $since_start->h, $since_start->i];
    }

    static function getTotalRekapAbsen($nip_nik = null, $tanggalHariIni = null)
    {
        $hari_ini = $tanggalHariIni;
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));
        $modelAbsensi = MasterAbsensi::find()
            ->where(['between', 'DATE(tanggal_masuk)', $tgl_pertama, $tgl_terakhir])
            ->andWhere(['nip_nik' => $nip_nik])
            ->orderBy('tanggal_masuk ASC')->all();

        $result = [];
        $hariKerja = 0;
        $datangTelatDetik = [];
        $datangTelatJam = [];
        $datangTelatMenit = [];

        $pulangCepatDetik = [];
        $pulangCepatJam = [];
        $pulangCepatMenit = [];


        $pulangLamaDetik = [];
        $pulangLamaJam = [];
        $pulangLamaMenit = [];

        $pulangCepat = [];
        $alfa = 0;
        $izinBiasa = 0;
        $izinSakit = 0;
        $jam_normal_masuk = "07:30:00";
        $jumlahAbsenPulangYangTidakDiisi = 0;

        foreach ($modelAbsensi as $itemAbsen) {
            // $result[]
            if ($itemAbsen->status == 'h') {
                $hariKerja += 1;
            }
            if ($itemAbsen->status == 'a') {
                $alfa += 1;
            }

            if ($itemAbsen->status == 'i') {
                $izinBiasa += 1;
            }

            if ($itemAbsen->status == 'ib') {
                $izinSakit += 1;
            }


            if ($itemAbsen->jam_keluar == null) {
                $jumlahAbsenPulangYangTidakDiisi += 1;
            }


            $jam_masuk = strtotime($itemAbsen->jam_masuk);
            $normalMasuk = strtotime($jam_normal_masuk);


            if ($jam_masuk > $normalMasuk) {
                $menghitungJumlahDatangTelat = Helper::mengitungSelisihMenit($itemAbsen->tanggal_masuk, "07:30:00", $itemAbsen->jam_masuk);
                $datangTelatDetik[] = $menghitungJumlahDatangTelat[0];
                $datangTelatJam[] = $menghitungJumlahDatangTelat[1];
                $datangTelatMenit[] = $menghitungJumlahDatangTelat[2];
            }

            // exit;
            $hari_kerja = ['Mon', 'Tue', 'Wed'];
            $tanggalMasuk = date('D', strtotime($itemAbsen->tanggal_masuk));


            $jamKeluar = strtotime($itemAbsen->jam_keluar);
            if (in_array($tanggalMasuk, $hari_kerja)) {
                $jam_normal_pulang = "16:00:00";
            } else {
                $jam_normal_pulang = "16:30:00";
            }

            if ($jamKeluar < strtotime($jam_normal_pulang) and $itemAbsen->jam_keluar != null) {

                $menghitungJumlahCepatPulang = Helper::mengitungSelisihMenit($itemAbsen->tanggal_masuk, $jam_normal_pulang, $itemAbsen->jam_keluar);

                $pulangCepatDetik[] = $menghitungJumlahCepatPulang[0];
                $pulangCepatJam[] = $menghitungJumlahCepatPulang[1];
                $pulangCepatMenit[] = $menghitungJumlahCepatPulang[2];
            }

            if ($jamKeluar > strtotime($jam_normal_pulang) and $itemAbsen->jam_keluar != null) {

                $menghitungJumlahCepatPulang = Helper::mengitungSelisihMenit($itemAbsen->tanggal_masuk, $jam_normal_pulang, $itemAbsen->jam_keluar);

                $pulangLamaDetik[] = $menghitungJumlahCepatPulang[0];
                $pulangLamaJam[] = $menghitungJumlahCepatPulang[1];
                $pulangLamaMenit[] = $menghitungJumlahCepatPulang[2];
            }
        }


        $detik = array_sum($datangTelatDetik);
        $jam = array_sum($datangTelatJam);
        $menit = array_sum($datangTelatMenit);


        //variabel jam keluar tapi cpt plg
        $detikCepatPulang = array_sum($pulangCepatDetik);
        $jamCepatPulang = array_sum($pulangCepatJam);
        $menitCepatPulang = array_sum($pulangCepatMenit);

        $detikLamaPulang = array_sum($pulangLamaDetik);
        $jamLamaPulang = array_sum($pulangLamaJam);
        $menitLamaPulang = array_sum($pulangLamaMenit);

        $result = [
            'hariKerja' => $hariKerja,
            'alfa' => $alfa,
            'izinBiasa' => $izinBiasa,
            'izinSakit' => $izinSakit,
            'datangTelat' => [
                'totalJam' => (int)Helper::convertToHoursMins($menit, '%02d'),
                'totalMenit' => $menit,
                'totalDetik' => number_format($detik, 0, ",", ".")
            ],
            'pulangCepat' => [
                'totalJam' => (int)Helper::convertToHoursMins($menitCepatPulang, '%02d'),
                'totalMenit' => $menitCepatPulang,
                'totalDetik' => number_format($detikCepatPulang, 0, ",", ".")
            ],
            'overTime' => [
                'totalJam' => (int)Helper::convertToHoursMins($menitLamaPulang, '%02d'),
                'totalMenit' => $menitLamaPulang,
                'totalDetik' => number_format($detikLamaPulang, 0, ",", ".")
            ],
            'jumlahAbsenPulangYangTidakDiisi' => $jumlahAbsenPulangYangTidakDiisi,
            'hariIni' => $hari_ini,
            'tglPertama' => $tgl_pertama,
            'tglTerakhir' => $tgl_terakhir

        ];
        return $result;
    }

    static function getAbsenDetail($nik)
    {

        $googleCalander = new HelperHari();
        date_default_timezone_set("Asia/Jakarta");
        $data = MasterPegawai::find()
            ->where(['id_nip_nrp' => $nik])
            ->one();
        $hari_kerja = ['Sat', 'Sun'];
        if (Yii::$app->request->isPost) {
            $d = cal_days_in_month(CAL_GREGORIAN, $_POST['bulan'], date('Y'));
            $hariLiburNasional = $googleCalander->cekNationalFreeDay($_POST['bulan']);
        } else {
            $d = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime('-1 Months')), date('Y', strtotime('-1 Months')));
            $hariLiburNasional = $googleCalander->cekNationalFreeDay();
        }

        for ($i = 1; $i <= $d; $i++) {


            if ($i < 10) {
                $n =  '0' . $i;
            } else {
                $n = $i;
            }
            if (Yii::$app->request->isPost) {
                $tanggal = strlen($i) ==  2 ? date('Y-' . $_POST['bulan'] . '-' .  $n) : date('Y-' . "0" . $_POST['bulan'] . '-'  .  $n);
            } else {
                $tanggal = strlen($n) ==  2 ? date('Y-m-' .  $n, strtotime('-1 Months')) : date('Y-m-' . "0" .  $n, strtotime('-1 Months'));
            }
            $dHari = date('D', strtotime($tanggal));



            $absen_masuk_pegawai = MasterAbsensi::find()
                ->where(['=', 'tanggal_masuk', $tanggal])
                ->andWhere(['nip_nik' => $nik])
                ->orderBy(['id_tb_absensi' => SORT_ASC])
                ->one();


            // var_dump($absen_masuk_pegawai);
            // exit;
            if ($absen_masuk_pegawai != null) {

                $status = null;
                if ($absen_masuk_pegawai->status == 'h') {
                    $status = 'H';
                } elseif ($absen_masuk_pegawai->status == 'i') {
                    $status = 'I';
                } else {
                    $status = 'Ib';
                }
                $absensis[$data->pegawai_id]['absensi'][$i]['kehadiran'] = "<span style='color:green;'>$status</span>";
            } elseif (in_array($tanggal, $hariLiburNasional)) {
                $absensis[$data->pegawai_id]['absensi'][$i]['kehadiran'] = "<span style='color:red;'>LN</span>";
            } elseif (in_array($dHari, $hari_kerja)) {
                $absensis[$data->pegawai_id]['absensi'][$i]['kehadiran'] = "<span style='color:red;'>L</span>";
            } else {
                $absensis[$data->pegawai_id]['absensi'][$i]['kehadiran'] = "<span style='color:blue;'></span>";
            }
        }
        return $absensis;
    }
}
