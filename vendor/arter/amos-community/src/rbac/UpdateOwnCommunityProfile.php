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
namespace arter\amos\community\rbac;

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\core\user\User;
use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Class UpdateOwnUserProfile
 * @package arter\amos\community\rbac
 */
class UpdateOwnCommunityProfile extends Rule
{
    public $name = 'isYourCommunityProfile';
    public $description = '';

    public function execute($user, $item, $params)
    {
        $post = \Yii::$app->getRequest()->post();
        $get = \Yii::$app->getRequest()->get();

        $userProfileId = User::findOne($user)->getProfile()->id;
        if (isset($get['id']) && $userProfileId) {
            return true;
        } elseif (isset($post['id']) && $userProfileId) {
            return true;
        }

        return false;
    }
}
