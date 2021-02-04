<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "absensi.tb_notif".
 *
 * @property int $id_notif
 * @property string $type_notif
 * @property string|null $isi_notifikasi
 * @property string|null $kepada
 * @property string|null $status_notif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $id_unik
 * @property string|null $headline
 */
class NotifikasiFirebase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_notif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_notif'], 'required'],
            [['type_notif', 'isi_notifikasi', 'kepada', 'status_notif', 'id_unik'], 'string'],
            [['created_at'], 'safe'],
            [['created_by', 'headline'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_notif' => 'Id Notif',
            'type_notif' => 'Type Notif',
            'isi_notifikasi' => 'Isi Notifikasi',
            'kepada' => 'Kepada',
            'status_notif' => 'Status Notif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'id_unik' => 'Id Unik',
            'headline' => 'Headline',
        ];
    }
}
