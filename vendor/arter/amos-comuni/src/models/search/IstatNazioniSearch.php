<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comuni\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use arter\amos\comuni\models\IstatNazioni;

/**
 * IstatNazioniSearch represents the model behind the search form about `arter\amos\comuni\models\IstatNazioni`.
 */
class IstatNazioniSearch extends IstatNazioni
{
    public function rules()
    {
        return [
            [['id', 'area', 'unione_europea', 'istat_continenti_id'], 'integer'],
            [['nome', 'nome_inglese'], 'safe'],
        ];
    }

    public function scenarios()
    {
// bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = IstatNazioni::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'area' => $this->area,
            'unione_europea' => $this->unione_europea,
            'istat_continenti_id' => $this->istat_continenti_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'nome_inglese', $this->nome_inglese]);

        return $dataProvider;
    }
}
