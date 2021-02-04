<?php

use app\components\Helper;
use app\models\Absensi\MasterAbsensi;

$this->title = 'Rekap Absen';
$this->params['breadcrumbs'][] = $this->title;
// error_reporting(0)
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h3 class="text-muted font-14 mb-3">
                Laporan Absensi
            </h3>

            <div class="table-responsive">
                <table border="1" style="width: 100%">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center; padding:2px;font-size: 10px">#</th>
                            <th rowspan="2" style="text-align: center; padding:2px;font-size: 10px">Nama</th>
                            <th rowspan="2" style="text-align: center; padding:2px;font-size: 10px">NIP</th>
                            <th colspan="31" style="text-align: center; padding:2px;font-size: 10px">Tanggal</th>
                        </tr>
                        <tr>
                            <?php
                            $d = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

                            for ($i = 1; $i <= $d; $i++) : ?>

                                <th style="text-align: center; padding:2px;font-size: 10px"><?= $i ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; padding:2px;font-size: 10px">1</td>
                            <td style="text-align: center; padding:2px;font-size: 10px"><?= $pegawai->nama_lengkap ?></td>
                            <td style="text-align: center; padding:2px;font-size: 10px"><?= $pegawai->id_nip_nrp ?></td>
                            <?php for ($i = 1; $i <= $d; $i++) { ?>
                                <?php
                                $tanggal = strlen($i) ==  2 ? date('Y-m-' . $i) : date('Y-m-' . "0" . $i);
                                $hari_kerja = ['Sat', 'Sun'];
                                $dHari = date('D', strtotime($tanggal));
                                $status =  null;

                                $MasterAbsensi = MasterAbsensi::find()
                                    ->where(['tanggal_masuk' => $tanggal])
                                    ->andWhere(['nip_nik' => $pegawai->id_nip_nrp])->one();

                                // var_dump($MasterAbsensi);
                                if ($MasterAbsensi != null) {
                                    $status =  "<span style='color:green;'>H</span>";
                                } elseif (in_array($tanggal, $HariLibur)) {
                                    $status =  "<span style='color:red;'>LN</span>";
                                } elseif (in_array($dHari, $hari_kerja)) {
                                    $status =  "<span style='color:red;'>L</span>";
                                } else {
                                    $status = "<span style='color:blue;'>A</span>";
                                }



                                ?>
                                <td style="text-align: center; padding:2px;font-size: 10px"><?= $status ?></td>

                            <?php } ?>

                    </tbody>
                </table>
                <br>
                <div class="">
                    <span class="badge badge-success">H : Hadir</span>
                    <span class="badge badge-info">A : ALFA</span>
                    <span class="badge badge-danger">LN/L : Hari Libur Nasional atau Libur Kerja</span>
                </div>
            </div>
        </div>
        <br>
        <div class="card card-body">
            <div class="table-responsive">
                <table border="1" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 1%; text-align: center; padding:2px;font-size:12px">Hari</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Jam Masuk</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Jam Keluar</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Status Jam Masuk</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Status Jam Pulang</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Jam Kerja</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Over Time ( OT )</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Jumlah Cepat Pulang</th>
                            <th style="width: 2%; text-align: center; padding:2px;font-size:12px">Jumlah Telat Datang</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_plg_cepat_null = null;
                        $total_dtg_lambat_null = null;
                        foreach ($data_absen as $dataabsen) : ?>
                            <tr>
                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?php

                                    $hari = date('D', strtotime($dataabsen->tanggal_masuk));
                                    echo Helper::hari_ini($hari) . " , " . Helper::tgl_indo($dataabsen->tanggal_masuk);
                                    ?>
                                </td>
                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?= $dataabsen->jam_masuk == null ? $dataabsen->status : $dataabsen->jam_masuk ?>
                                </td>
                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?= $dataabsen->jam_keluar == null ? "Tidak Mengisi Jam Pulang" : $dataabsen->jam_keluar ?>
                                </td>
                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?php
                                    //								echo date('D', strtotime($dataabsen->tanggal_masuk));
                                    $hari_kerja = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
                                    $dataAbsen = date('D', strtotime($dataabsen->tanggal_masuk));

                                    $jam_normal = null;
                                    if (in_array($dataabsen, $hari_kerja)) {
                                        $jam_normal = "07:45:00";
                                    } else {
                                        $jam_normal = "07:45:00";
                                    }
                                    $a = strtotime($jam_normal);
                                    $b = strtotime($dataabsen->jam_masuk);
                                    if ($dataabsen->status == 'L') {
                                        echo 'Libur';
                                    } else {
                                        if ($b > $a) {
                                            echo 'Terlambat';
                                        } else if ($b == $a) {
                                            echo 'Normal';
                                        } else {
                                            echo 'Lebih Cepat';
                                        }
                                    }
                                    ?>
                                </td>


                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?php
                                    $hari_kerja = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
                                    $dataAbsen_hari = date('D', strtotime($dataabsen->tanggal_masuk));

                                    $jam_normal_pulang = null;
                                    if (in_array($dataAbsen_hari, $hari_kerja)) {
                                        $jam_normal_pulang = "15:45:00";
                                    } else {
                                        $jam_normal_pulang = "16:15:00";
                                    }
                                    $a = strtotime($jam_normal_pulang);
                                    $b = strtotime($dataabsen->jam_keluar);
                                    // var_dump($b);
                                    if ($b) {
                                        if ($dataabsen->status == 'L') {
                                            echo 'Libur';
                                        } else {
                                            //									echo $b . "-" .$a;
                                            if ($b > $a) {
                                                echo 'Normal';
                                            } else if ($b == $a) {
                                                echo 'Pulang Seperti Biasa';
                                            } else {
                                                echo 'Lebih Cepat';
                                            }
                                        }
                                    } else {
                                        echo 'Tidak Mengisi Jam Pulang';
                                    }
                                    // if (isset($data_absen->jam_keluar)) {
                                    //     echo 'Tidak Mengisi Jam Pulang';
                                    // } else {

                                    // }
                                    ?>
                                </td>
                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?php

                                    // var_dump(empty($dataabsen->jam_masuk));
                                    if (empty($dataabsen->jam_masuk) || empty($dataabsen->jam_keluar)) {

                                        echo "Tidak Mengisi Jam Pulang";
                                    } else {
                                        echo Helper::menghitung_selisih($dataabsen->jam_keluar, $dataabsen->jam_masuk);
                                    }

                                    ?>
                                </td>
                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?php
                                    if ($dataabsen->status == 'L') {
                                        echo 'Libur';
                                    } else {
                                        $hari_kerja = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
                                        $dataAbsen_keluar = date('D', strtotime($dataabsen->tanggal_masuk));

                                        $jam_normal_pulang = null;
                                        if (in_array($dataAbsen_keluar, $hari_kerja)) {
                                            $jam_normal_pulang = "15:40:00";
                                        } else {
                                            $jam_normal_pulang = "16:15:00";
                                        }

                                        $jam_keluar = strtotime($dataabsen->jam_keluar);
                                        $jam_normal = strtotime($jam_normal_pulang);

                                        if ($jam_keluar > $jam_normal) {

                                            echo Helper::menghitung_jumlah_ovt($dataabsen->jam_keluar, $jam_normal_pulang);
                                        } else {
                                            echo 'Tidak Ada Lembur';
                                        }
                                    }
                                    ?>
                                </td>
                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?php
                                    if (is_null($dataabsen->jam_keluar)) {
                                        echo 'Tidak Mengisi Jam Pulang';

                                        $total_plg_cepat = 0;
                                    } else {
                                        if ($dataabsen->status == 'L') {
                                            echo 'Libur';
                                        } else {
                                            $hari_kerja = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
                                            $dataAbsen_cpt_plg = date('D', strtotime($dataabsen->tanggal_masuk));

                                            $jam_normal_pulang = null;
                                            if (in_array($dataAbsen_cpt_plg, $hari_kerja)) {
                                                $jam_normal_pulang = "15:45:00";
                                            } else {
                                                $jam_normal_pulang = "16:15:00";
                                            }

                                            $jam_keluar = strtotime($dataabsen->jam_keluar);
                                            $jam_normal = strtotime($jam_normal_pulang);

                                            if ($jam_keluar < $jam_normal) {

                                                $total_plg_cepat = Helper::menghitung_jumlah_cpt_pulang($dataabsen->jam_keluar, $jam_normal_pulang);
                                                //										echo $total_plg_cepat;
                                                echo $total_plg_cepat . " Menit Lebih Cepat";
                                            } else {
                                                $total_plg_cepat = 0;
                                                echo 'Tidak Pulang Cepat';
                                            }
                                        }
                                    }
                                    ?>
                                </td>

                                <td style="width: 2%; text-align: center;font-size: 10px">
                                    <?php
                                    if ($dataabsen->status == 'L') {
                                        echo 'Libur';
                                    } else {
                                        $hari_kerja = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
                                        $dataAbsen_tlt_datang = date('D', strtotime($dataabsen->tanggal_masuk));

                                        $jam_normal_pulang = null;
                                        if (in_array($dataAbsen_tlt_datang, $hari_kerja)) {
                                            $jam_normal_masuk = "07:45:00";
                                        } else {
                                            $jam_normal_masuk = "07:45:00";
                                        }

                                        $total_tlt_datang = Helper::menghitung_jumlah_tlt_datang($dataabsen->tanggal_masuk, "07:45:00", $dataabsen->jam_masuk);

                                        $jam_masuk = strtotime($dataabsen->jam_masuk);
                                        $jam_normal_masuk = strtotime($jam_normal_masuk);
                                        // var_dump($dataabsen->jam_masuk);

                                        // if($jm)
                                        // echo $total_tlt_datang;
                                        if ($jam_masuk > $jam_normal_masuk) {
                                            //     //										echo $total_plg_cepat;
                                            // $tlt = $total_tlt_datang . " Menit";
                                            // echo $tlt;
                                            echo '-';
                                        } else {
                                            $total_tlt_datang = 0;
                                            echo 'Tidak Datang Telat';
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                        <?php
                            $total_plg_cepat_null += $total_plg_cepat;
                            $total_dtg_lambat_null += $total_tlt_datang;
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <hr>
                <table border="1" style="width: 100%">
                    <tr>
                        <th style="width: 2%; text-align: center;">Jumlah Pulang Cepat</th>
                        <td style="width: 2%; text-align: center;"><?= floor($total_plg_cepat_null / 60) ?>
                            Jam <?= floor($total_plg_cepat_null % 60) ?> Menit
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 2%; text-align: center;">Jumlah Telat Datang</th>
                        <td style="width: 2%; text-align: center;">

                            <?php
                            if ($total_dtg_lambat_null == 0) {
                                echo "Tidak Ada Waktu Terlambat";
                            } else {
                                echo floor($total_dtg_lambat_null / 60) . " Jam " . "dan " . floor($total_dtg_lambat_null % 60) . " Menit";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 2%; text-align: center;">Jumlah Kelebihan Jam Kerja</th>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>