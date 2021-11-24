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
 * @package    arter-report
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace arter\amos\report\models;

use yii\helpers\ArrayHelper;

class ReportType extends \arter\amos\report\models\base\ReportType
{
    /**
     * @see    \yii\db\BaseActiveRecord::init()    for more info.
     */
    public function init()
    {
        parent::init();
    }

    public function afterFind()
    {
        parent::afterFind();
    }
    /**
     * @see    \yii\base\Component::behaviors()    for more info.
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
        ]);
    }
}