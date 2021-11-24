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
 * @author Nicolas.Thomas
 * @since 15.08.2016
 */

namespace rossmann\cron\components\validation;


use common\components\db\CustomActiveRecord;
use common\models\Campaigns\CampaignStatuses;
use common\models\Campaigns\CampaignTypes;
use common\models\Coupons\CouponTemplates;
use common\models\LegalTexts\LegalContainers;
use rossmann\cron\components\TaskManager;
use Yii;
use yii\validators\Validator;

class CommandValidator extends Validator {

    /**
     * @param CustomActiveRecord $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute) {
        if ($command = TaskManager::validateCommand($model->$attribute)) {
            $model->$attribute = $command;
        } else {
            $this->addError($model, $attribute, Yii::t('rbac-admin', 'invalid_command'));
        }
    }
}
