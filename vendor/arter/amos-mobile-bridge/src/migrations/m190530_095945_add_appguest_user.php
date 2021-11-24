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


use arter\amos\admin\models\UserProfile;
use arter\amos\admin\utility\UserProfileUtility;
use arter\amos\core\user\User;
use arter\amos\mobile\bridge\modules\v1\models\AccessTokens;
use yii\db\Migration;
use yii\helpers\Console;

/**
 * Class m190530_095945_add_appguest_user
 */
class m190530_095945_add_appguest_user extends Migration
{
    
    const APPUSERNAME = 'appguest';
    const APP_TOKEN_DEFAULT = 'FkkGThrNLDmujP78TfxgXECkrq5PH6sy';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            $user = new User();

            $user->username = self::APPUSERNAME;
            $user->save(false);
            $userprofile = new UserProfile();
            $userprofile->user_id = $user->id;
            $userprofile->status = \Yii::$app->getWorkflowSource()->getWorkflow(UserProfile::USERPROFILE_WORKFLOW)->getInitialStatusId();
     
            $userprofile->save(false);
            $token = new AccessTokens();
            $token->access_token = self::APP_TOKEN_DEFAULT;
            $token->user_id = $user->id;
            $token->save();
            
            UserProfileUtility::setBasicUserRoleToUser($user->id);
            
        } catch (Exception $ex) {
            Console::error($ex->getMessage());
            Console::error($ex->getTraceAsString());
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        try{
            $user = User::findOne(['username' => self::APPUSERNAME]);
            if(!is_null($user))
            {
                $user_profile = UserProfile::findOne(['user_id' => $user->id]);
                if(!is_null($user_profile)){
                    $user_profile->delete();
                }
                $token = AccessTokens::findOne(['user_id' => $user->id]);
                if(!is_null($token)){
                    $token->delete();
                }
                $user->delete();
            }
            
        }catch(Exception $ex){
            Console::error($ex->getTraceAsString());
        }

        return true;
    }
}
