<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "absensi.tb_pengumuman".
 *
 * @property int $id_pengumuman
 * @property string $title
 * @property string $isi
 * @property string|null $file
 * @property string|null $author
 * @property string|null $created_at
 * @property string|null $update_by
 * @property string|null $update_at
 * @property string|null $to
 * @property string|null $status
 * @property string|null $kategori
 * @property string|null $image_encode
 */
class Pengumuman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'absensi.tb_pengumuman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'isi'], 'required'],
            [['title', 'image_encode','isi', 'update_by', 'to', 'kategori'], 'string'],
            [['created_at', 'update_at'], 'safe'],
            [['author', 'status'], 'string', 'max' => 100],
            [['file'], 'file', 'skipOnEmpty' => true, 'maxSize' => 11002400, 'tooBig' => 'Ukuran file tidak boleh lebih dari 10 MB (KB)',],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pengumuman' => 'Id Pengumuman',
            'title' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'file' => 'File',
            'author' => 'Author',
            'created_at' => 'Created At',
            'update_by' => 'Update By',
            'update_at' => 'Update At',
            'to' => 'To ( Ditunjukan Untuk Siapa/Instansi ?)',
            'status' => 'Status',
            'kategori' => 'Kategori',
        ];
    }
}
