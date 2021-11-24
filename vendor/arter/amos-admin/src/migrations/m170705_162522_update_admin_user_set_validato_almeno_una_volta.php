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

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\core\user\User;
use yii\db\Migration;

class m170705_162522_update_admin_user_set_validato_almeno_una_volta extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $adminUser = User::findOne(['username' => 'admin']);
        if (is_null($adminUser)) {
            MigrationCommon::printConsoleMessage(AmosAdmin::t('amosadmin', 'Utente admin non trovato'));
            return true;
        }
        try {
            $this->update(UserProfile::tableName(),
                [
                    'validato_almeno_una_volta' => 1,
                    'status' => UserProfile::USERPROFILE_WORKFLOW_STATUS_VALIDATED,
                ],
                [
                    'user_id' => $adminUser->id
                ]);
            MigrationCommon::printConsoleMessage(AmosAdmin::t('amosadmin', 'Utente admin aggiornato correttamente'));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $adminUser = User::findOne(['username' => 'admin']);
        if (is_null($adminUser)) {
            MigrationCommon::printConsoleMessage(AmosAdmin::t('amosadmin', 'Utente admin non trovato'));
            return true;
        }
        try {
            $this->update(UserProfile::tableName(),
                [
                    'validato_almeno_una_volta' => 0,
                    'status' => UserProfile::USERPROFILE_WORKFLOW_STATUS_DRAFT,
                ],
                [
                    'user_id' => $adminUser->id
                ]);
            MigrationCommon::printConsoleMessage(AmosAdmin::t('amosadmin', 'Utente admin aggiornato correttamente'));
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}
