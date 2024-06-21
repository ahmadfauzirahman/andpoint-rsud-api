<?php

namespace app\models\Absensi;

use Yii;

/**
 * This is the model class for table "absensi.tb_order_jadwal".
 *
 * @property int $id_order_jadwal
 * @property string|null $kode_sub_rumpun
 * @property string|null $bulan
 * @property string|null $tahun
 * @property string|null $created_by
 * @property string|null $created_at
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
            [['kode_sub_rumpun', 'bulan', 'tahun', 'created_by'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_order_jadwal' => 'Id Order Jadwal',
            'kode_sub_rumpun' => 'Kode Sub Rumpun',
            'bulan' => 'Bulan',
            'tahun' => 'Tahun',
            'created_by' => 'Dibuat Oleh',
            'created_at' => 'Created At',
        ];
    }
}
