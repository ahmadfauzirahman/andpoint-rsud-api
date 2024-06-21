<?php

namespace app\models\Kepegawaian;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kepegawaian\Master\MasterUnitPenempatan;

/**
 * MasterUnitPenempatanSearch represents the model behind the search form of `app\models\Kepegawaian\Master\MasterUnitPenempatan`.
 */
class MasterUnitPenempatanSearch extends MasterUnitPenempatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'unit_rumpun'], 'integer'],
            [['nama', 'kode_unitsub_maping_simrs'], 'safe'],
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
        $query = MasterUnitPenempatan::find();

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
            'kode' => $this->kode,
            'unit_rumpun' => $this->unit_rumpun,
        ]);

        $query->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'kode_unitsub_maping_simrs', $this->kode_unitsub_maping_simrs]);

        return $dataProvider;
    }
}
