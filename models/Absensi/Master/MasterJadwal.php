<?php

namespace app\models\Absensi\Master;

use Yii;

/**
 * This is the model class for table "absensi.tb_jadwal".
 *
 * @property int $id_jadwal
 * @property string|null $senin_kamis_masuk
 * @property string|null $jumat
 * @property string|null $sabtu
 * @property string|null $status_pegawai
 * @property string|null $status_jadwal
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
            [['senin_kamis_masuk', 'jumat', 'sabtu','status_jadwal'], 'safe'],
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
            'senin_kamis_masuk' => 'Senin Kamis',
            'jumat' => 'Jumat',
            'sabtu' => 'Sabtu',
            'status_pegawai' => 'Status Pegawai',
        ];
    }
}
