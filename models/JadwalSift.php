<?php

namespace app\models;

use app\models\Kepegawaian\MasterPegawai;
use Yii;

/**
 * This is the model class for table "absensi.tb_jadwal_sift".
 *
 * @property int $id_jadwal_sift
 * @property string|null $identitas_pegawai
 * @property string|null $bln
 * @property string|null $schedule
 * @property string|null $thn
 * @property string|null $created_by
 */
class JadwalSift extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_jadwal_sift';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identitas_pegawai', 'bln', 'schedule', 'thn', 'created_by'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jadwal_sift' => 'Id Jadwal Sift',
            'identitas_pegawai' => 'Identitas Pegawai',
            'bln' => 'Bln',
            'schedule' => 'Schedule',
            'thn' => 'Thn',
            'created_by' => 'Created By',
        ];
    }

    public function getPegawai()
    {
        return $this->hasOne(MasterPegawai::className(), ['id_nip_nrp' => 'identitas_pegawai']);
    }
}
