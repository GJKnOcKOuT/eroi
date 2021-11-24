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
 * @package    arter\amos\core\record
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\record;

use backend\modules\admin\models\UserProfile;
use \arter\amos\core\record\Record;
use \arter\amos\audit\AuditTrailBehavior;
use \yii\db\ActiveQuery;
use \yii\helpers\ArrayHelper;

class AmosRecordAudit extends Record
{
    /*public function behaviors()
    {

        $behaviorsParent = parent::behaviors();

        $behaviors = [
            'auditTrailBehavior' => [
                'class' => AuditTrailBehavior::className()
            ],
        ];

        return ArrayHelper::merge($behaviorsParent, $behaviors);
    }*/
}