<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notas;

/**
 * NotasSearch represents the model behind the search form of `app\models\Notas`.
 */
class NotasSearch extends Notas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idnotas', 'proyecto'], 'integer'],
            [['corte1', 'corte2', 'corte3'], 'number'],
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
        $query = Notas::find();

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
            'idnotas' => $this->idnotas,
            'corte1' => $this->corte1,
            'corte2' => $this->corte2,
            'corte3' => $this->corte3,
            'proyecto' => $this->proyecto,
        ]);

        return $dataProvider;
    }
}
