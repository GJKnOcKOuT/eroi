<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
 
use backend\modules\aster_admin\models\UserProfile;
use yii\db\Migration;
use arter\amos\core\user\User;
use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\admin\AmosAdmin;

/**
 * Class m200408_121435_empty_privacy_values
 */
class m200408_121435_empty_privacy_values extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        $keyword = 'admin';
        $resetprivacy = 0;
        $adminUsers = User::find()->select('id')
                        ->andWhere(['like', User::tableName() . '.username', $keyword])
                        ->asArray()->column();

        try {
            $this->update(UserProfile::tableName(),
                    [
                        'privacy' => $resetprivacy,
                    ],
                    [
                        'not in', 'user_id', $adminUsers,
            ]);


            MigrationCommon::printConsoleMessage(AmosAdmin::t('amosadmin', 'Privacy resettata correttamente'));
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage($exception->getMessage());
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $keyword = 'admin';
        $resetprivacy = 1;
        $adminUsers = User::find()->select('id')
                        ->andWhere(['like', User::tableName() . '.username', $keyword])
                        ->asArray()->column();
        try {
            $this->update(UserProfile::tableName(),
                    [
                        'privacy' => $resetprivacy,
                    ],
                    [
                        'not in', 'user_id', $adminUsers,
            ]);
            MigrationCommon::printConsoleMessage(AmosAdmin::t('amosadmin', 'Privacy resettata correttamente'));
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage($exception->getMessage());
            return false;
        }
        return true;
    }

}
