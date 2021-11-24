<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_organizzazioni\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_organizzazioni\models;

use arter\amos\organizzazioni\models\ProfiloSedi as AmosProfiloSedi;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class ProfiloSedi
 * This is the model class for table "profilo_sedi".
 *
 * @property \arter\amos\organizzazioni\models\OrganizationsPlaces $sedeIndirizzo
 * @property string $addressField
 *
 * @package arter\aster\organizzazioni\models
 */
class ProfiloSedi extends AmosProfiloSedi
{
    /**
     * Return the columns to show as default in GridViewWidget
     * @param bool $showActionColumns
     * @return array
     */
    public function getBaseGridViewColumns()
    {
        return [
            'name',
            'addressField:raw',
        ];
    }
}
