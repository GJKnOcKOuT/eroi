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

use arter\amos\een\models\EenTagS3TagEenMm;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EenTagS3TagEenMmSearch represents the model behind the search form about `arter\amos\een\models\EenTagS3TagEenMm`.
 */
class EenTagS3TagEenMmSearch extends EenTagS3TagEenMm
{

//private $container;
public $isSearch;
public $tag;

    public function __construct(array $config = [])
    {
        $this->isSearch = true;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['id', 'een_tag_een_id', 'tag_s3_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            ['EenTagEen', 'safe'],
            ['Tag', 'safe'],
        ];
    }

    public function scenarios()
    {
// bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = EenTagS3TagEenMm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('eenTagEen');
        $query->joinWith('tag');

        $dataProvider->setSort([
            'attributes' => [
                'tag_s3_id' => [
                    'asc' => ['een_tag_s3_tag_een_mm.tag_s3_id' => SORT_ASC],
                    'desc' => ['een_tag_s3_tag_een_mm.tag_s3_id' => SORT_DESC],
                ],
                'een_tag_een_id' => [
                    'asc' => ['een_tag_s3_tag_een_mm.een_tag_een_id' => SORT_ASC],
                    'desc' => ['een_tag_s3_tag_een_mm.een_tag_een_id' => SORT_DESC],
                ],
                'description' => [
                    'asc' => ['een_tag_s3_tag_een_mm.description' => SORT_ASC],
                    'desc' => ['een_tag_s3_tag_een_mm.description' => SORT_DESC],
                ],
                'created_at' => [
                    'asc' => ['een_tag_s3_tag_een_mm.created_at' => SORT_ASC],
                    'desc' => ['een_tag_s3_tag_een_mm.created_at' => SORT_DESC],
                ],
                'eenTagEen' => [
                    'asc' => ['een_tag_een.id_een' => SORT_ASC],
                    'desc' => ['een_tag_een.id_een' => SORT_DESC],
                ], 'tag' => [
                    'asc' => ['tag.id' => SORT_ASC],
                    'desc' => ['tag.id' => SORT_DESC],
                ],]]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'een_tag_een_id' => $this->een_tag_een_id,
            'tag_s3_id' => $this->tag_s3_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', new \yii\db\Expression('een_tag_een.id_een'), $this->EenTagEen]);
        $query->andFilterWhere(['like', new \yii\db\Expression('tag.id'), $this->Tag]);

        return $dataProvider;
    }
}
