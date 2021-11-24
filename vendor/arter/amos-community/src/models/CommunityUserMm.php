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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\models;
use yii\db\ActiveQuery;

/**
 * Class CommunityUserMm
 * This is the model class for table "community_user_mm".
 * @package backend\modules\corsi\models
 */
class CommunityUserMm extends \arter\amos\community\models\base\CommunityUserMm
{

    /**
     * Gets the list of community manager email address for a specific community
     *
     * @param integer $communityId The Id of community to search community/user relations
     * @return array $emailArray The array containing community manager email
     */
    public function getCommunityManagerMailList($communityId){

        /** @var ActiveQuery $queryManagers */
        $community = Community::findOne($communityId);
        $callingModule = \Yii::createObject($community->context);
        $managerRole = $callingModule->getManagerRole();
        $queryManagers = CommunityUserMm::find()->andWhere([
            'community_id' => $communityId,
            'role' => $managerRole
        ]);
        $queryManagers->innerJoin('user', 'user_id = user.id');
        $queryManagers->select('user.email');
        $emailArray = $queryManagers->column();
        return $emailArray;
    }

}
