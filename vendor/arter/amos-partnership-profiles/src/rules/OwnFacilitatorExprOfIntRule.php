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
 * @package    arter\amos\partnershipprofiles\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\rules;

use arter\amos\admin\rules\DefaultFacilitatorOwnContentRule;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;

/**
 * Class OwnFacilitatorExprOfIntRule
 * @package arter\amos\partnershipprofiles\rules
 */
abstract class OwnFacilitatorExprOfIntRule extends DefaultFacilitatorOwnContentRule
{
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $ok = false;
        if (parent::execute($user, $item, $params)) {
            if (isset($params['model'])) {
                /** @var ExpressionsOfInterest $model */
                $model = $params['model'];
                if (!$model->id) {
                    $post = \Yii::$app->getRequest()->post();
                    $get = \Yii::$app->getRequest()->get();
                    if (isset($get['id'])) {
                        $model = $this->instanceModel($model, $get['id']);
                    } elseif (isset($post['id'])) {
                        $model = $this->instanceModel($model, $post['id']);
                    }
                }
                $allowedPartnershipProfileStates = [
                    PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED,
                    PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED
                ];
                $ok = (
                    ($model->status == ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_DRAFT) &&
                    in_array($model->partnershipProfile->status, $allowedPartnershipProfileStates)
                );
            }
        }
        return $ok;
    }
}
