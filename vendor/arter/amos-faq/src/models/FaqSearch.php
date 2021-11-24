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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\faq\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use arter\amos\core\interfaces\CmsModelInterface;
use arter\amos\core\record\CmsField;

/**
 * FaqSearch represents the model behind the search form about `arter\amos\src\models\Faq`.
 */
class FaqSearch extends Faq implements CmsModelInterface
{

    public $faq_widgets_id;
    
    public function rules()
    {
        return [
            [['id', 'order', 'created_by', 'updated_by', 'deleted_by', 'version', 'faq_categories_id', 'faq_stato_id'], 'integer'],
            [['domanda', 'risposta', 'created_at', 'updated_at', 'deleted_at', 'rotte','faq_widgets_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
// bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Faq::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->joinWith('faqStato')->andWhere(['faq_stato.id' => 3]);
        $query->joinWith('amosWidgets')->orderBy('order');

        $query->andFilterWhere([
            'id' => $this->id,
            'order' => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'version' => $this->version,
            'faq_categories_id' => $this->faq_categories_id,
            'faq_stato_id' => $this->faq_stato_id,
        ]);
        if(isset($this->faq_widgets_id)){
           $query->andFilterWhere(['classname' => $this->faq_widgets_id]);
        }
        $rotteTradotte = $this->rotte;
        while ($indx = strpos($rotteTradotte, "\\")) {
            $endString = strlen($rotteTradotte);
            if ($indx < $endString) {
                $rotteTradotte = substr($rotteTradotte, 0, $indx) . substr($rotteTradotte, $indx + 1, $endString);
            } else {
                $rotteTradotte = substr($rotteTradotte, 0, $indx);
            }
        }

        $query->andFilterWhere(['like', 'domanda', $this->domanda])
            ->andFilterWhere(['like', 'risposta', $this->risposta])         
            ->andFilterWhere(['like', 'rotte', $rotteTradotte]);
        return $dataProvider;
    }

     
    /***
     * CmsModelInterface
     */
    
   /**
     * Search method useful to retrieve news to show in frontend (with cms)
     *
     * @param $params
     * @param int|null $limit

     * @return ActiveDataProvider
     */
    public function cmsSearch($params, $limit = null) {
        $dataProvider = $this->search($params, $limit, 'all');

        return $dataProvider;
    }

    public function cmsViewFields() {
        $viewFields = [];
        array_push($viewFields, new CmsField("domanda", "TEXT", 'amosfaq', $this->attributeLabels()["domanda"]));
        array_push($viewFields, new CmsField("risposta", "TEXT", 'amosfaq', $this->attributeLabels()['risposta']));


        return $viewFields;
    }

    public function cmsSearchFields() {
        $searchFields = [];

        array_push($searchFields, new CmsField("domanda", "TEXT"));
        array_push($searchFields, new CmsField("risposta", "TEXT"));

        return $searchFields;
    }
        
    /**
     * 
     * @param type $id
     * @return boolean
     */
    public function cmsIsVisible($id)
    {   
        $retValue = true;
        
        return $retValue;
    }


}
