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
 * Class m200115_085954_update_all_aster_partnership_profiles_model_db_refs
 */
class m200115_085954_update_all_aster_partnership_profiles_model_db_refs extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        }

        $newClassName = \backend\modules\aster_partnership_profiles\models\PartnershipProfiles::className();
        $oldClassName = \arter\amos\partnershipprofiles\models\PartnershipProfiles::className();

        // Aggiornamento tabella amos_workflow_transitions_log
        try {
            $this->update(
                'amos_workflow_transitions_log',
                ['classname' => $newClassName],
                ['classname' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella amos_workflow_transitions_log');
            return false;
        }

        // Aggiornamento tabella attach_file
        try {
            $this->update(
                'attach_file',
                ['model' => $newClassName],
                ['model' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella attach_file');
            return false;
        }

        // Aggiornamento tabella attach_file_refs
        try {
            $this->update(
                'attach_file_refs',
                ['model' => $newClassName],
                ['model' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella attach_file_refs');
            return false;
        }

        // Aggiornamento tabella auth_assignment create
        try {
            $this->update(
                'auth_assignment',
                ['item_name' => 'CWH_PERMISSION_CREATE_' . $newClassName],
                ['item_name' => 'CWH_PERMISSION_CREATE_' . $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella auth_assignment create');
            return false;
        }

        // Aggiornamento tabella auth_assignment validate
        try {
            $this->update(
                'auth_assignment',
                ['item_name' => 'CWH_PERMISSION_VALIDATE_' . $newClassName],
                ['item_name' => 'CWH_PERMISSION_VALIDATE_' . $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella auth_assignment validate');
            return false;
        }

        // Aggiornamento tabella auth_item 1
        try {
            $this->update(
                'auth_item',
                ['name' => 'CWH_PERMISSION_CREATE_' . $newClassName],
                ['name' => 'CWH_PERMISSION_CREATE_' . $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella auth_item 1');
            return false;
        }

        // Aggiornamento tabella auth_item 2
        try {
            $this->update(
                'auth_item',
                ['name' => 'CWH_PERMISSION_VALIDATE_' . $newClassName],
                ['name' => 'CWH_PERMISSION_VALIDATE_' . $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella auth_item 2');
            return false;
        }

        // Aggiornamento tabella cwh_auth_assignment create
        try {
            $this->update(
                'cwh_auth_assignment',
                ['item_name' => 'CWH_PERMISSION_CREATE_' . $newClassName],
                ['item_name' => 'CWH_PERMISSION_CREATE_' . $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella cwh_auth_assignment create');
            return false;
        }

        // Aggiornamento tabella cwh_auth_assignment validate
        try {
            $this->update(
                'cwh_auth_assignment',
                ['item_name' => 'CWH_PERMISSION_VALIDATE_' . $newClassName],
                ['item_name' => 'CWH_PERMISSION_VALIDATE_' . $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella cwh_auth_assignment validate');
            return false;
        }

        // Aggiornamento tabella cwh_config_contents
        try {
            $this->update(
                'cwh_config_contents',
                ['classname' => $newClassName],
                ['classname' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella cwh_config_contents');
            return false;
        }

        // Aggiornamento tabella entitys_tags_mm
        try {
            $this->update(
                'entitys_tags_mm',
                ['classname' => $newClassName],
                ['classname' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella entitys_tags_mm');
            return false;
        }

        // Aggiornamento tabella models_classname
        try {
            $this->update(
                'models_classname',
                ['classname' => $newClassName],
                ['classname' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella models_classname');
            return false;
        }

        // Aggiornamento tabella notification
        try {
            $this->update(
                'notification',
                ['class_name' => $newClassName],
                ['class_name' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella notification');
            return false;
        }

        // Aggiornamento tabella tag_models_auth_items_mm
        try {
            $this->update(
                'tag_models_auth_items_mm',
                ['classname' => $newClassName],
                ['classname' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella tag_models_auth_items_mm');
            return false;
        }

        // Aggiornamento tabella translation_conf
        try {
            $this->update(
                'translation_conf',
                ['namespace' => $newClassName],
                ['namespace' => $oldClassName]
            );
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella translation_conf');
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
        echo "m200115_085954_update_all_aster_partnership_profiles_model_db_refs cannot be reverted.\n";
        return false;
    }
}
