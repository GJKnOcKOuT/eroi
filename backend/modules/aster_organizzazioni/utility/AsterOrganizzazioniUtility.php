<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_organizzazioni\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_organizzazioni\utility;

use arter\amos\organizzazioni\models\ProfiloTypesPmi;
use yii\helpers\ArrayHelper;

/**
 * Class AsterOrganizzazioniUtility
 * @package backend\modules\aster_organizzazioni\utility
 */
class AsterOrganizzazioniUtility
{
    /**
     * Returns the organization typology values ready for select.
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public static function getTipologiaOrganizzazioniReadyForSelect()
    {
        return ArrayHelper::map(ProfiloTypesPmi::find()->orderBy(['priority' => SORT_ASC])->all(), 'id', 'name');
    }
}
