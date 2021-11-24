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

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "cwh_auth_assignment".
 */
class CwhAuthAssignmentSearch extends \arter\amos\cwh\models\base\CwhAuthAssignment
{
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['item_name', 'cwh_nodi_id'],'string'],
            [['item_name', 'cwh_nodi_id'],'safe'],
        ];
    }

    public function scenarios()
    {
// bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CwhAuthAssignmentSearch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'cwh_nodi_id' => $this->cwh_nodi_id,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name]);



        return $dataProvider;
    }

}
