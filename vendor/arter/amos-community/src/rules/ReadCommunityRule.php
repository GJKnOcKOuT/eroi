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

namespace arter\amos\community\rules;
use arter\amos\admin\models\UserProfile;
use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityType;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;

/**
 * Class UpdateOwnExprOfIntRule
 * @package arter\amos\partnershipprofiles\rules
 */
class ReadCommunityRule extends \arter\amos\core\rules\BasicContentRule
{
    public $name = 'ReadCommunity';

    /**
     * Rule to Read Community
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var Community $model */
        if($model->community_type_id == CommunityType::COMMUNITY_TYPE_OPEN || $model->community_type_id == CommunityType::COMMUNITY_TYPE_PRIVATE){
            return true;
        } elseif($model->community_type_id == CommunityType::COMMUNITY_TYPE_CLOSED){
            $communityUserMm = CommunityUserMm::find()->andWhere(['community_id' => $model->id])->andWhere(['user_id' => $user])->one();
            if(!empty($communityUserMm)) {
                return true;
            }
        }
        return false;
    }
}
