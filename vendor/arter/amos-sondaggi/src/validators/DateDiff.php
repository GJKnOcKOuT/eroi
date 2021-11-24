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


namespace arter\amos\sondaggi\validators;

/*
 * Classe che estende la Validator base per aggiungere
 * altri validatori alle domande custom, praticamente è necessaria
 * una classe per ogni nuovo metodo di validazione
 */

use yii\validators\Validator;
use arter\amos\sondaggi\AmosSondaggi;

class DateDiff extends Validator
{
    public $value   = 18;
    public $message = 'The date is not within the requirements';
 
    public function validateAttribute($model, $attribute)
    {
        $year     = date('Y', strtotime($model->$attribute));
        $nowYear  = date('Y');
        $diffYear = $nowYear - $year;
        if ($diffYear == $this->value) {
            $now  = date('md');
            $data = date('md', strtotime($model->$attribute));
            if ($data <= $now) {
                return true;
            } 
        } else if ($diffYear > $this->value) {
            return true;
        }

        $this->addError($model, $attribute, \Yii::t('amossondaggi', $this->message));

        return false;
    }
}