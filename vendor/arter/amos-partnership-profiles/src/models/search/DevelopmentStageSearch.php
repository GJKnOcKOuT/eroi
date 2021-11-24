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
 * @package    arter\amos\partnershipprofiles\models\search
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\models\search;

use arter\amos\partnershipprofiles\models\DevelopmentStage;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class DevelopmentStageSearch
 * DevelopmentStageSearch represents the model behind the search form about `arter\amos\partnershipprofiles\models\DevelopmentStage`.
 * @package arter\amos\partnershipprofiles\models\search
 */
class DevelopmentStageSearch extends DevelopmentStage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['value', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DevelopmentStage::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'value' => [
                    'asc' => [self::tableName() . '.value' => SORT_ASC],
                    'desc' => [self::tableName() . '.value' => SORT_DESC],
                ],
            ]]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
        ]);
        
        $query->andFilterWhere(['like', self::tableName() . '.value', $this->value]);
        
        return $dataProvider;
    }
}
