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

namespace arter\amos\community\rules;

use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\core\rules\DefaultOwnContentRule;
use yii\helpers\Url;

/**
 * Class CreateSubcommunitiesRule
 * @package arter\amos\community\rules
 */
class AuthorRoleRule extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'authorRole';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $cwhModule = \Yii::$app->getModule('cwh');
        if (isset($params['model'])) {
            if (isset($cwhModule)) {
                $cwhModule->setCwhScopeFromSession();
                if (!empty($cwhModule->userEntityRelationTable)) {
                    $entityId = $cwhModule->userEntityRelationTable['entity_id'];
                    $model = Community::findOne($entityId);
                    return $this->hasRole($user, $model);
                }
            }
        }
        else {
            //  Check you have the permission when you are in the community dashboard
           $currentUrl = explode("?", Url::current());
            if($currentUrl[0]=='/community/join/index'){
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['id'])) {
                    $model = Community::findOne($get['id']);
                } elseif (isset($post['id'])) {
                    $model = Community::findOne($post['id']);
                }
                if(!empty($model)) {
                    return $this->hasRole($user, $model);
                }
            }
        }
        return false;
    }

    /**
     * @param $user_id
     * @param $model Community
     * @return bool
     */
    public function hasRole($user_id, $model){
        $communityUserMm = CommunityUserMm::find()
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['community_id' => $model->id])
            ->andWhere(['role' => CommunityUserMm::ROLE_AUTHOR])
            ->one();

        if(!empty($communityUserMm)){
            return true;
        }
        return false;
    }
}
