<?php

namespace app\models\Absensi;

use Yii;

/**
 * This is the model class for table "absensi.tb_master_jadwal".
 *
 * @property string $kode_jadwal
 * @property string|null $jam_masuk
 * @property string|null $jam_keluar
 */
class MasterJadwal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_master_jadwal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_jadwal'], 'required'],
            [['jam_masuk', 'jam_keluar'], 'safe'],
            [['kode_jadwal'], 'string', 'max' => 100],
            [['kode_jadwal'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_jadwal' => 'Kode Jadwal',
            'jam_masuk' => 'Jam Masuk',
            'jam_keluar' => 'Jam Keluar',
        ];
    }
}
