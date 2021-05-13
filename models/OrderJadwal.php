<?php

namespace app\models;

use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use app\models\Kepegawaian\Master\MasterUnitSubPenempatan;
use app\models\Kepegawaian\ModelSearch\MasterPegawai;
use Yii;

/**
 * This is the model class for table "absensi.tb_order_jadwal".
 *
 * @property int $id_order_jadwal
 * @property string|null $identitas
 * @property string|null $jadwal
 * @property string|null $keterangan
 * @property string|null $unit
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $jenis
 */
class OrderJadwal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_order_jadwal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identitas', 'keterangan', 'created_by', 'jenis'], 'string'],
            [['jadwal', 'created_at', 'unit'], 'safe'],
            [['jadwal'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order_jadwal' => 'Id Order Jadwal',
            'identitas' => 'Pembuat Absen',
            'jadwal' => 'Jadwal (Bulan dan Tahun)',
            'keterangan' => 'Keterangan',
            'unit' => 'Absen Untuk',
            'jenis' => 'Jenis Absensi',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    public function getSub()
    {
        return $this->hasOne(MasterUnitSubPenempatan::className(), ['kode' => 'unit']);
    }


    // public function getUnit()
    // {
    //     return $this->hasOne(MasterUnitPenempatan::className(), ['kode' => 'unit']);
    // }
    // public function get

    public function getPegawai()
    {
        return $this->hasOne(MasterPegawai::className(), ['id_nip_nrp' => 'identitas']);
    }

    public function getJadwalsift()
    {
        return $this->hasMany(JadwalSift::className(), ['id_order' => 'id_order_jadwal']);
    }
}
