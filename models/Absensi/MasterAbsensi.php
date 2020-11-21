<?php

namespace app\models\Absensi;

use app\models\Kepegawaian\MasterPegawai;
use Yii;

/**
 * This is the model class for table "absensi.tb_absensi".
 *
 * @property int $id_tb_absensi
 * @property string|null $id_pegawai
 * @property string|null $nip_nik
 * @property string $jam_masuk
 * @property string $jam_keluar
 * @property string|null $tanggal_masuk
 * @property string|null $lat
 * @property string|null $long
 * @property string|null $status
 * @property string|null $how
 */
class MasterAbsensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_absensi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jam_masuk', 'jam_keluar', 'tanggal_masuk', 'how'], 'safe'],
            [['id_pegawai', 'status'], 'string', 'max' => 30],
            [['nip_nik'], 'string', 'max' => 40],
            [['lat', 'long'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tb_absensi' => 'Id Tb Absensi',
            'id_pegawai' => 'Nama Pegawai',
            'nip_nik' => 'Nip/Nik',
            'jam_masuk' => 'Jam Masuk',
            'jam_keluar' => 'Jam Keluar',
            'tanggal_masuk' => 'Tanggal Masuk',
            'lat' => 'Latitude',
            'long' => 'Longitude',
            'status' => 'Status Absensi',
        ];
    }

    public function getPegawai()
    {
        return $this->hasOne(MasterPegawai::className(), ['pegawai_id' => 'id_pegawai']);
    }

    public function getUnit()
    {
        }
}
