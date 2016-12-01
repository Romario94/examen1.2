<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Persona;

/**
 * PersonaSearch represents the model behind the search form about `common\models\Persona`.
 */
class PersonaSearch extends Persona
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'idD'], 'integer'],
            [['nombreP'], 'safe'],
            [['saldo'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Persona::find();

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
            'uid' => $this->uid,
            'idD' => $this->idD,
            'saldo' => $this->saldo,
        ]);

        $query->andFilterWhere(['like', 'nombreP', $this->nombreP]);

        return $dataProvider;
    }
}
