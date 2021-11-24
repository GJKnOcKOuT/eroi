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


namespace arter\amos\een\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use arter\amos\een\models\EenTagEen;
use yii\db\Expression;

/**
 * EenTagEenSearch represents the model behind the search form about `arter\amos\een\models\EenTagEen`.
 */
class EenTagEenSearch extends EenTagEen
{

//private $container;

    public function __construct(array $config = [])
    {
        $this->isSearch = true;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description', 'id_een', 'created_at', 'updated_at', 'deleted_at','name'], 'safe'],
        ];
    }

    public function scenarios()
    {
// bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = EenTagEen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false,
        ]);

        $query->joinWith('eenTagS3TagEenMm');
        $query->distinct();


        $query->orderBy(new expression('een_tag_een_id IS NOT NULL, id_een ASC') );

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }



        $query->andFilterWhere([
            'een_tag_een.id' => $this->id,
            'een_tag_een.created_at' => $this->created_at,
            'een_tag_een.updated_at' => $this->updated_at,
            'een_tag_een.deleted_at' => $this->deleted_at,
            'een_tag_een.created_by' => $this->created_by,
            'een_tag_een.updated_by' => $this->updated_by,
            'een_tag_een.deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'een_tag_een.description', $this->description])
            ->andFilterWhere(['like', 'een_tag_een.id_een', $this->id_een]);

        return $dataProvider;
    }
}