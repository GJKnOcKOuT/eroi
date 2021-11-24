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

namespace arter\amos\translation\models\search;


use arter\amos\translation\utility\TranslationUtility;
use yii\base\Model;

class TranslationSearch extends Model
{
    public $isTranslated;
    public $attributes;
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['isTranslated','attributes'], 'safe'],
        ];
    }

}