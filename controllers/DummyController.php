<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Faker;

class DummyController extends Controller
{

    public function actionIndex($row = 10, $iterate = 1)
    {
        $start = microtime(true);
        $faker = Faker\Factory::create();
        $datas = [];
        for ($j = 1; $j <= $iterate; $j++) {
            for ($i = 1; $i <= $row; $i++) {
                $datas[$i] = [
                    '3',
                    '1471116310890021',
                    $faker->dateTimeThisCentury->format('H:i:s'),
                    $faker->dateTimeThisCentury->format('H:i:s'),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    '0.522063',
                    '101.4500354',
                    'h'
                ];
            }
            \Yii::$app->db->createCommand()->batchInsert(
                'absensi.tb_absensi',
                [
                    'id_pegawai',
                    'nip_nik',
                    'jam_masuk',
                    'jam_keluar',
                    'tanggal_masuk',
                    'lat',
                    'long',
                    'status'
                ],
                $datas
            )->execute();
        }

        $time_elapsed_us = microtime(true) - $start;
        echo ($row * $iterate) . ' = ' . $time_elapsed_us . ' <br>';
    }
}
