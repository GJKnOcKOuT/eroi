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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\cwh\models\search;

use arter\amos\cwh\models\CwhRegolePubblicazione;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CwhRegolePubblicazioneSearch represents the model behind the search form about `arter\amos\cwh\models\CwhRegolePubblicazione`.
 */
class CwhRegolePubblicazioneSearch extends CwhRegolePubblicazione
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'codice'], 'safe'],
        ];
    }

    public function scenarios()
    {
// bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CwhRegolePubblicazione::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'codice', $this->codice]);

        return $dataProvider;
    }
}
