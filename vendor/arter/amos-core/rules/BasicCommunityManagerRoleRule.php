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
 * @package    arter\amos\community\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\rules;


use yii\helpers\Url;

/**
 * Class CreateSubcommunitiesRule
 * @package arter\amos\community\rules
 */
class BasicCommunityManagerRoleRule extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'basicCommunityManagerRole';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        // used by deleteCommunityMnagerContentRule that extend this class in every content,
        // at moment is disabled to avoid that a community manager can delete a content published by an other user in another community


//        $cwhModule = \Yii::$app->getModule('cwh');
//        if (isset($params['model'])) {
//            if (isset($cwhModule)) {
//                $cwhModule->setCwhScopeFromSession();
//                if (!empty($cwhModule->userEntityRelationTable)) {
//                    $entityId = $cwhModule->userEntityRelationTable['entity_id'];
//                    $model =  \arter\amos\community\models\Community::findOne($entityId);
//                    return $this->hasRole($user, $model);
//                }
//            }
//        }
        return false;
    }

    /**
     * @param $user_id
     * @param $model Community
     * @return bool
     */
    public function hasRole($user_id, $model){
        $communityUserMm = \arter\amos\community\models\CommunityUserMm::find()
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['community_id' => $model->id])
            ->andWhere(['role' => \arter\amos\community\models\CommunityUserMm::ROLE_COMMUNITY_MANAGER])
            ->one();

        if(!empty($communityUserMm)){
            return true;
        }
        return false;
    }
}
