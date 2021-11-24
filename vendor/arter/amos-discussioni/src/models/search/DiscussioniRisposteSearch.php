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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\discussioni\models\search;

use arter\amos\discussioni\models\DiscussioniRisposte;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DiscussioniRisposteSearch represents the model behind the search form about `arter\amos\discussioni\models\DiscussioniRisposte`.
 */
class DiscussioniRisposteSearch extends DiscussioniRisposte
{
    public function rules()
    {
        return [
            [['id', 'discussioni_topic_id', 'created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
            [['testo', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = DiscussioniRisposte::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'discussioni_topic_id' => $this->discussioni_topic_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'version' => $this->version,
        ]);

        $query->andFilterWhere(['like', 'testo', $this->testo]);

        return $dataProvider;
    }
}
