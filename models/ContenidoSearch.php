<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contenido;

/**
 * ContenidoSearch represents the model behind the search form of `app\models\Contenido`.
 */
class ContenidoSearch extends Contenido
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcontenido', 'materia', 'proyecto'], 'integer'],
            [['contenido', 'descripcion'], 'safe'],
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
        $query = Contenido::find();

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
            'idcontenido' => $this->idcontenido,
            'materia' => $this->materia,
            'proyecto' => $this->proyecto,
        ]);

        $query->andFilterWhere(['like', 'contenido', $this->contenido])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
