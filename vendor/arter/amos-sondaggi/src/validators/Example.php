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

class Example extends Validator {

    public function validateAttribute($model, $attribute) {
        $errore = FALSE;
        if ($errore) {
            $this->addError($model, $attribute, AmosSondaggi::t('amossondaggi', 'La descrizione dell\'errore.'));
        }
    }

}

?>