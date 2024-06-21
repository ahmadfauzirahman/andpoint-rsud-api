<h3 align="center">LAPORAN ABSENSI ESELON RUMAH SAKIT UMUM DAERAH ARIFIN ACHMAD PROVINSI RIAU</h3>
<h3 align="center">PEMERINTAH PROVINSI RIAU</h3>
<table border="1" style="width: 100%;border-collapse: collapse;font-size: 12px;">
	<thead>
		<tr>
			<th rowspan="2" width="2%" style="text-align: center; padding:10px">#</th>
			<th rowspan="2" width=10%; style="text-align: center; padding:10px">NIP</th>
			<th rowspan="2" width=10%; style="text-align: center;  padding:10px">Nama</th>
			<th colspan="6" style="text-align: center; width:70%; padding:2px">Rekap Absensi</th>
		</tr>
		<tr>
			<th style="padding:10px;width:10%;text-align: center">Total Hadir</th>
			<th style="padding:10px;width:10%;text-align: center">Total Alfa</th>
			<th style="padding:10px;width:10%;text-align: center">Total Sakit</th>
			<th style="padding:10px;width:10%;text-align: center">Total Izin Biasa</th>
			<th style="padding:10px;width:10%;text-align: center">Datang Terlambat</th>
			<th style="padding:10px;width:10%;text-align: center">Pulang Cepat</th>
		</tr>
	</thead>
	<tbody>
		<?php

		use app\components\Helper;
		use app\models\Absensi\MasterAbsensi;
		use PHPUnit\TextUI\Help;

		$no = 1;
		foreach ($queryAll as $itemAbsen) { ?>

			<?php
			$total = Helper::getTotalRekapAbsen($itemAbsen['id_nip_nrp'], date('Y-m-d'))
			?>
			<tr>
				<td style="padding: 2px;text-align: center;"><?= $no ?></td>
				<td style="padding: 5px;"><?= $itemAbsen['id_nip_nrp'] ?></td>
				<td style="padding: 5px;"><?= $itemAbsen['nama_lengkap'] ?></td>
				<td style="text-align: center;">
					<?= $total['hariKerja'] ?>
				</td>
				<td style="text-align: center;">
					<?= $total['alfa'] ?>
				</td>
				<td style="text-align: center;">
					<?= $total['izinSakit'] ?>
				</td>
				<td style="text-align: center;">
					<?= $total['izinBiasa'] ?>
				</td>
				<td style="text-align: center;">

					<?php
					$totalJam =	$total['datangTelat']['totalJam'] == 0 ? null : $total['datangTelat']['totalJam'] . ' Jam '
					?>
					<?= $totalJam . $total['datangTelat']['totalMenit']  . ' Menit' ?>
				</td>
				<td style="text-align: center;">

					<?php
					$totalJam =	$total['pulangCepat']['totalJam'] == 0 ? null : $total['pulangCepat']['totalJam'] . ' Jam '
					?>
					<?= $totalJam . $total['pulangCepat']['totalMenit']  . ' Menit' ?>
				</td>
			</tr>

		<?php $no++;
		} ?>
	</tbody>
</table>

<?php

$no = 1;
foreach ($queryAll as $itemAbsens) {
	$data = Helper::getAbsenDetail($itemAbsens['id_nip_nrp']);
	if ($no != 0) echo '<pagebreak></pagebreak>';
?>
	<h4>Laporan Absensi <?= $itemAbsens['nama_lengkap'] ?></h4>

	<table border="1" style="width: 100%;border-collapse: collapse;font-size: 12px;">
		<thead>
			<tr>
				<th rowspan="2" width="2%" style="text-align: center; padding:2px">#</th>
				<th rowspan="2" style="width: 13%; text-align: center; padding:2px">NIP</th>
				<th rowspan="2" style="width: 15%; text-align: center; padding:2px">Nama</th>
				<th colspan="31" style="text-align: center; width:70%; padding:2px">Tanggal</th>
			</tr>
			<tr>
				<?php
				$d = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

				for ($i = 1; $i <= $d; $i++) { ?>
					<th style="width:  2%; text-align: center; padding:2px"><?= $i ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="padding: 5px;">1</td>
				<td style="padding: 5px;"><?= $itemAbsens['id_nip_nrp'] ?></td>
				<td style="padding: 5px;"><?= $itemAbsens['nama_lengkap'] ?></td>
				<?php foreach ($data as $item) { ?>
					<?php foreach ($item['absensi'] as $dt_absen) : ?>
						<th style="width:  2%; text-align: center; padding:2px"><?= $dt_absen['kehadiran'] ?></th>
					<?php endforeach; ?>
				<?php } ?>
			</tr>
		</tbody>
	</table>
	<table border="1" style="width: 100%;border-collapse: collapse;margin-top: 10px;">
		<thead>
			<tr>
				<th width= "10%;" style="text-align: center; padding:2px;">Hari</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Jam Masuk</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Jam Keluar</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Status Jam Masuk</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Status Jam Pulang</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Jam Kerja</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Over Time ( OT )</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Jumlah Cepat Pulang</th>
				<th width= "20%;" style="text-align: center; padding:2px;">Jumlah Telat Datang</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$hari_ini = date("Y-m-d");
			$tgl_pertama = date('Y-m-01', strtotime($hari_ini));
			$tgl_terakhir = date('Y-m-t', strtotime($hari_ini));
			$absensi = MasterAbsensi::find()
				->where(['between', 'tanggal_masuk', $tgl_pertama, $tgl_terakhir])
				->andWhere(['nip_nik' => $itemAbsens['id_nip_nrp']])
				->orderBy(['id_tb_absensi' => SORT_ASC])
				->all();
			foreach ($absensi as $dataabsen) {
			?>
				<tr>
					<td width=10%; style="text-align: center;">
						<?php
						$hari = date('D', strtotime($dataabsen->tanggal_masuk));
						echo Helper::hari_ini($hari) . " , " . Helper::tgl_indo($dataabsen->tanggal_masuk);
						?>
					</td>
					<td style="text-align: center;">
						<?= $dataabsen->jam_masuk == null ? $dataabsen->status : $dataabsen->jam_masuk ?>
					</td>
					<td style="text-align: center;;">
						<?= $dataabsen->jam_keluar == null ? "Tidak Mengisi Jam Pulang" : $dataabsen->jam_keluar ?>
					</td>
					<td style=" text-align: center;;">
						<?php
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
					<td style=" text-align: center;;">
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
                        ?>
                    </td>
					<td style=" text-align: center;">
                        <?php

                        // var_dump(empty($dataabsen->jam_masuk));
                        if (empty($dataabsen->jam_masuk) || empty($dataabsen->jam_keluar)) {

                            echo "Tidak Mengisi Jam Pulang";
                        } else {
                            echo Helper::menghitung_selisih($dataabsen->jam_keluar, $dataabsen->jam_masuk);
                        }

                        ?>
                    </td>
					<td style=" text-align: center;">
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
                    <td style=" text-align: center;">
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
                    <td style=" text-align: center;">
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
			<?php  } ?>
		</tbody>
	</table>
<?php
}
?>