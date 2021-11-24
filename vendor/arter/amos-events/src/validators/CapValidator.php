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
 * @package    arter\amos\events\validators
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\validators;

use arter\amos\events\AmosEvents;
use yii\validators\Validator;

/**
 * Class CapValidator
 * @package arter\amos\events\validators
 */
class CapValidator extends Validator
{
    /**
     * @param \arter\amos\core\record\Record $model
     * @param string $attribute
     * @return boolean
     */
    function validateAttribute($model, $attribute)
    {
        $pi = $model->$attribute;
        if (strlen($pi) != 5) {
            $this->addError($model, $attribute, AmosEvents::t('amosevents', 'Not valid CAP. Length does not comply.'));
            return false;
        }
        if (!is_numeric($pi)) {
            $this->addError($model, $attribute, AmosEvents::t('amosevents', 'Not valid CAP. It presents non-numeric values.'));
            return false;
        }
        return true;
    }
}
