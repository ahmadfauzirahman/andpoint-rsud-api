<?php

namespace app\models\Absensi\Master;

use app\models\Kepegawaian\Master\MasterUnitPenempatan;
use Yii;

/**
 * This is the model class for table "absensi.tb_jadwal".
 *
 * @property int $id_jadwal
 * @property string|null $senin_rabu_masuk
 * @property string|null $kamis
 * @property string|null $jumat
 * @property string|null $status_pegawai
 * @property string|null $status_jadwal
 * @property string|null $is_del
 * @property string|null $kode_unit_kerja
 */
class MasterJadwal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_jadwal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['senin_rabu_masuk', 'is_del', 'kamis', 'jumat', 'status_jadwal', 'kode_unit_kerja'], 'safe'],
            [['status_pegawai'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jadwal' => 'Id Jadwal',
            'senin_rabu_masuk' => 'Senin Rabu',
            'kamis' => 'Kamis',
            'jumat' => 'Jumat',
            'status_pegawai' => 'Status Pegawai',
            'kode_unit_kerja' => 'Unit Kerja',
        ];
    }

    public function getUnit()
    {
        return $this->hasOne(MasterUnitPenempatan::className(),['kode'=> 'kode_unit_kerja']);
    }
}
