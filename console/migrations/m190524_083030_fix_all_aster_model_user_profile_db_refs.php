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

use arter\amos\core\migration\libs\common\MigrationCommon;
use yii\db\Migration;

/**
 * Class m190524_083030_fix_all_aster_model_user_profile_db_refs
 */
class m190524_083030_fix_all_aster_model_user_profile_db_refs extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        }

        $asterUserProfileClassName = \backend\modules\aster_admin\models\UserProfile::className();
        $amosAdminUserProfileClassName = \arter\amos\admin\models\UserProfile::className();

        // Aggiornamento tabella attach_file_refs
        try {
            $this->update(
                'attach_file_refs',
                ['model' => $asterUserProfileClassName],
                ['model' => $amosAdminUserProfileClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella attach_file_refs');
            return false;
        }

        // Aggiornamento tabella amos_workflow_transitions_log
        try {
            $this->update(
                'amos_workflow_transitions_log',
                ['classname' => $asterUserProfileClassName],
                ['classname' => $amosAdminUserProfileClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella amos_workflow_transitions_log');
            return false;
        }

        // Aggiornamento tabella cwh_tag_owner_interest_mm
        try {
            $this->update(
                'cwh_tag_owner_interest_mm',
                ['classname' => $asterUserProfileClassName],
                ['classname' => $amosAdminUserProfileClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella cwh_tag_owner_interest_mm');
            return false;
        }

        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190524_083030_fix_all_aster_model_user_profile_db_refs cannot be reverted.\n";
        return false;
    }
}
