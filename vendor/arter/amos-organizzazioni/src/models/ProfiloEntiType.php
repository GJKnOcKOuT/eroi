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
 * @package    arter\amos\organizzazioni\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\models;

use arter\amos\organizzazioni\Module;

/**
 * Class ProfiloEntiType
 * This is the model class for table "profilo_enti_type".
 *
 * @property \arter\amos\organizzazioni\models\Profilo[] $profili
 *
 * @package arter\amos\organizzazioni\models
 */
class ProfiloEntiType extends \arter\amos\organizzazioni\models\base\ProfiloEntiType
{
    const TYPE_MUNICIPALITY = 1;
    const TYPE_OTHER_ENTITY = 2;

    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'name'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipalities()
    {
        $model = Module::instance()->createModel('ProfiloEntiType');
        return $this->getProfili()->andWhere([$model::tableName() . '.id' => ProfiloEntiType::TYPE_MUNICIPALITY]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherEntities()
    {
        $model = Module::instance()->createModel('ProfiloEntiType');
        return $this->getProfili()->andWhere([$model::tableName() . '.id' => ProfiloEntiType::TYPE_OTHER_ENTITY]);
    }
}
