<?php

namespace app\models\Absensi\ModelSearch;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Absensi\MasterAbsensi;

/**
 * MasterAbsensiSearch represents the model behind the search form of `app\models\Absensi\MasterAbsensi`.
 */
class MasterAbsensiSearch extends MasterAbsensi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tb_absensi'], 'integer'],
            [['id_pegawai', 'nip_nik', 'jam_masuk', 'jam_keluar', 'tanggal_masuk', 'lat', 'long', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MasterAbsensi::find()
            ->orderBy('id_tb_absensi DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_tb_absensi' => $this->id_tb_absensi,
            'jam_masuk' => $this->jam_masuk,
            'jam_keluar' => $this->jam_keluar,
            'tanggal_masuk' => $this->tanggal_masuk,
        ]);

        $query->andFilterWhere(['ilike', 'id_pegawai', $this->id_pegawai])
            ->andFilterWhere(['ilike', 'nip_nik', $this->nip_nik])
            ->andFilterWhere(['ilike', 'lat', $this->lat])
            ->andFilterWhere(['ilike', 'long', $this->long]);

        return $dataProvider;
    }
}
