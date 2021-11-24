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
 * @package    arter\amos\admin\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\rules;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use Yii;
use yii\rbac\Rule;

/**
 * Class ValidatedBasicUserRule
 * @package arter\amos\admin\rules
 */
class ValidatedBasicUserRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'validatedBasicUser';

    /**
     * @inheritdoc
     */
    public function execute($loggedUserId, $item, $params)
    {
        /** @var UserProfile $loggedUser */
        $loggedUser = \Yii::$app->getUser()->identity->profile;
        $adminModule = \Yii::$app->getModule(AmosAdmin::getModuleName());
        $communityModule = \Yii::$app->getModule('communty');
        $cwhModule = \Yii::$app->getModule('cwh');
        $scope = (!is_null($cwhModule) ? $cwhModule->getCwhScope() : []);
        
        if (($adminModule->createContentInMyOwnCommunityOnly === true) && (isset($scope['community']) && !(empty($communityModule)))) {
            if (isset($scope['community']) && !(empty($communityModule))) {
                $myOwnCommunities = $communityModule->getCommunitiesByUserId(Yii::$app->getUser()->getId(), true);

                return (in_array($scope['community'], $myOwnCommunities));
            }

            return false;
        }

        return ($loggedUser->validato_almeno_una_volta == true);
    }
}
