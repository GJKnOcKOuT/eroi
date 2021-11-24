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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\models\UserProfileArea;
use yii\db\Migration;

/**
 * Class m181012_162615_add_user_profile_area_field_1
 */
class m190215_132615_popolate_enable_facilitator_box extends Migration
{



    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $userIds = \Yii::$app->authManager->getUserIdsByRole('FACILITATOR');
        foreach ($userIds as $user_id){
            $userProfile = \arter\amos\admin\models\UserProfile::findOne(['user_id' => $user_id]);
            $userProfile->detachBehaviors();
            $userProfile->enable_facilitator_box = true;
            $userProfile->save(false);
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        return true;
    }
}
