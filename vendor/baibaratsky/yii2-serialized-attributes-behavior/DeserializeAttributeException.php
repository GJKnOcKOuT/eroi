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


namespace baibaratsky\yii\behaviors\model;

use yii\db\BaseActiveRecord;

/**
 * Class DeserializeAttributeException
 * @package baibaratsky\yii\behaviors\model
 */
class DeserializeAttributeException extends \Exception
{
    public function __construct(BaseActiveRecord $model, $attribute)
    {
        parent::__construct('Can’t deserialize attribute "' . $attribute . '" of "' . $model::className() . '".');
    }
}