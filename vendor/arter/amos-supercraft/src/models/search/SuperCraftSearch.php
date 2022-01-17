<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace arter\amos\supercraft\models;

use arter\amos\best\practice\models\BestPractice;
use yii\base\Model;

/**
 * BestPracticeSearch represents the model behind the search form about `arter\amos\best\practice\models\BestPractice`.
 */
class SuperCraftSearch extends SuperCraft
{
    private $container;

    /**
     * @inheritdoc
     */
    public function __construct(array $config = [])
    {
        /** @var bool $isSearch - it is the content model search class */
        $this->isSearch = true;
        parent::__construct($config);
        $this->modelClassName = SuperCraft::className();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_by', 'created_at'], 'safe'],
            [
                [
                    'created_at_from',
                    'created_at_to',
                ],
                'safe'
            ],
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

    public function getScope($params)
    {
        $scope = $this->formName();
        if (!isset($params[$scope])) {
            $scope = '';
        }
        return $scope;
    }

    /**
     * @inheritdoc
     */
    public function searchFieldsLike()
    {
        return [
            'title',
            'created_by',
            'created_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function searchFieldsGlobalSearch()
    {
        return [
            'title',
            'created_by',
            'created_at',
        ];
    }

    /**
     * @inheritdoc
     */
    public function applySearchFilters($query)
    {
        parent::applySearchFilters($query);

        $query->andFilterWhere(['>=', static::tableName() . '.created_at', $this->created_at_from]);
        $query->andFilterWhere(['<=', static::tableName() . '.created_at', $this->created_at_to]);
    }
}