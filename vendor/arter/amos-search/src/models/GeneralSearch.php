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

/**
 */

namespace arter\amos\search\models;


use arter\amos\core\behaviors\TaggableBehavior;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class GeneralSearch extends Model
{

    public $tagValues;

    public function rules()
    {
        return [
            ['tagValues','safe']
        ];
    }

    public function filterRequest($toFilterRequest){

        /*
        pr('here');
        die();
        */

        /*
        pr($toFilterQueryString);
        die();
        */
        $filteredRequest = [];

        foreach($toFilterRequest as $index => $value){         
            $filteredRequest[$index] = $this->filterQueryString($value);
            //pr($filteredRequest[$index]);
        }
        
        //pr($fileterdRequest);
        //die();

        return $filteredRequest;

    }

    public function filterQueryString($stringToFilter){
       $stringToFilter = \yii\helpers\HtmlPurifier::process(trim($stringToFilter));
       $stringToFilter = strip_tags($stringToFilter);
       $stringToFilter = addslashes($stringToFilter);
        /*
       pr($stringToFilter);
        die();
        */
       return $stringToFilter;
    }

}