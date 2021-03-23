<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderJadwal;

/**
 * OrderJadwalSearch represents the model behind the search form of `app\models\OrderJadwal`.
 */
class OrderJadwalSearch extends OrderJadwal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order_jadwal'], 'integer'],
            [['identitas', 'jadwal', 'keterangan', 'unit', 'created_at', 'created_by'], 'safe'],
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
        $query = OrderJadwal::find();

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
            'id_order_jadwal' => $this->id_order_jadwal,
            'jadwal' => $this->jadwal,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'identitas', $this->identitas])
            ->andFilterWhere(['ilike', 'keterangan', $this->keterangan])
            ->andFilterWhere(['ilike', 'unit', $this->unit])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
