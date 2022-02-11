<?php

namespace backend\modules\supercraft\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\supercraft\models\ProcessoAziendale;
use yii\db\Query;

/**
 * PaSearch represents the model behind the search form of `app\models\ProcessoAziendale`.
 */
class PaSearch extends ProcessoAziendale
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_processo_aziendale', 'id_processo_innovativo', 'id_azienda'], 'integer'],
            [['nome', 'data_inizio', 'data_fine', 'descrizione', 'copertina', 'id_fase_attuale'], 'safe'],
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
        $query = ProcessoAziendale::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $params = [1, 0, 0];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        {
            // grid filtering conditions
            $query->andFilterWhere([
                'id_processo_aziendale' => $this->id_processo_aziendale,
                'id_processo_innovativo' => $this->id_processo_innovativo,
                'id_azienda' => $this->id_azienda,
                'data_inizio' => $this->data_inizio,
                'data_fine' => $this->data_fine,
            ]);

            $query->andFilterWhere(['like', 'nome', $this->nome])
                ->andFilterWhere(['like', 'descrizione', $this->descrizione])
                ->andFilterWhere(['like', 'copertina', $this->copertina])
                ->andFilterWhere(['like', 'id_fase_attuale', $this->id_fase_attuale]);


            return $dataProvider;
        }
    }
}
