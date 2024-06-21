<?php

namespace app\components;

class Konversi
{

    public static function toInt($hari)
    {
        $int = strtolower($hari);
        switch ($int) {
            case 'senin':
                return 1;
                break;
            case 'selasa':
                return 2;
                break;
            case 'rabu':
                return 3;
                break;
            case 'kamis':
                return 4;
                break;
            case 'jumat':
                return 5;
                break;
            case 'sabtu':
                return 6;
                break;

            default:
                return 'Not Found';
                break;
        }
    }

    public static function toDay($int)
    {
        $day = strtolower($int);
        switch ($day) {
            case 1:
                return 'senin';
                break;
            case 2:
                return 'selasa';
                break;
            case 3:
                return 'rabu';
                break;
            case 4:
                return 'kamis';
                break;
            case 5:
                return 'jumat';
                break;
            case 6:
                return 'sabtu';
                break;

            default:
                return 'Not Found';
                break;
        }
    }

    public static function setTimesMinutes($time)
    {
        $jam = date('H:i', strtotime($time));
        $jamconvert = explode(':', $jam);
        $minutes = $jamconvert[0] * 60 + $jamconvert[1];

        return $minutes;
    }

    public static function setMinutesTime($minutes)
    {

        $h = (string)floor($minutes / 60);
        $i = (string)($minutes - ($h * 60));

        $count_h = strlen($h);
        $count_i = strlen($i);


        $h = $count_h == 1 ? '0' . $h : $h;
        $i = $count_i == 1 ? '0' . $i : $i;

        return $h . ':' . $i;
    }

    public static function changeDateDayStyle($tanggal, $day)
    {
        $Data = explode("-", $tanggal);
        $Tahun = $Data[0];
        $D2 = $Data[1];
        if ($D2 == '01') {
            $Bulan = 'Januari';
        }
        if ($D2 == '02') {
            $Bulan = 'Februari';
        }
        if ($D2 == '03') {
            $Bulan = 'Maret';
        }
        if ($D2 == '04') {
            $Bulan = 'April';
        }
        if ($D2 == '05') {
            $Bulan = 'Mei';
        }
        if ($D2 == '06') {
            $Bulan = 'Juni';
        }
        if ($D2 == '07') {
            $Bulan = 'Juli';
        }
        if ($D2 == '08') {
            $Bulan = 'Agustus';
        }
        if ($D2 == '09') {
            $Bulan = 'September';
        }
        if ($D2 == '10') {
            $Bulan = 'Oktober';
        }
        if ($D2 == '11') {
            $Bulan = 'November';
        }
        if ($D2 == '12') {
            $Bulan = 'Desember';
        }
        $Hari = $Data[2];

        switch ($day) {
            case 'Sunday':
                $translateDay = 'Minggu';
                break;
            case 'Monday':
                $translateDay = 'Senin';
                break;
            case 'Tuesday':
                $translateDay = 'Selasa';
                break;
            case 'Wednesday':
                $translateDay = 'Rabu';
                break;
            case 'Thursday':
                $translateDay = 'Kamis';
                break;
            case 'Friday':
                $translateDay = 'Jumat';
                break;
            case 'Saturday':
                $translateDay = 'Sabtu';
                break;
        }


        return $translateDay . ', ' . $Hari . ' ' . $Bulan . ' ' . $Tahun;
    }

    public static function bulanIndo($bulan)
    {
        switch ($bulan) {
            case "01":
                $hasil = 'Januari';
                break;
            case "02":
                $hasil = 'Februari';
                break;
            case "03":
                $hasil = 'Maret';
                break;
            case "04":
                $hasil = 'April';
                break;
            case "05":
                $hasil = 'Mei';
                break;
            case "06":
                $hasil = 'Juni';
                break;
            case "07":
                $hasil = 'Juli';
                break;
            case "08":
                $hasil = 'Agustus';
                break;
            case "09":
                $hasil = 'September';
                break;
            case "10":
                $hasil = 'Oktober';
                break;
            case "11":
                $hasil = 'November';
                break;
            case "12":
                $hasil = 'Desember';
                break;
        }

        return $hasil;
    }

    public static function tgl_indo($tanggal)
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
}
