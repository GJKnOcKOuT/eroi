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
use arter\amos\cwh\models\CwhConfigContents;
use yii\db\Migration;

/**
 * Class m201217_105208_add_arter_een_cwh_config_contents
 */
class m201217_105208_add_arter_een_cwh_config_contents extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $eenConf = CwhConfigContents::findOne(['tablename' => 'een_partnership_proposal']);
        if (is_null($eenConf)) {
            $now = date('Y-m-d H:i:s');
            try {
                $this->insert(CwhConfigContents::tableName(), [
                    'id' => 8,
                    'tablename' => 'een_partnership_proposal',
                    'classname' => 'arter\amos\een\models\EenPartnershipProposal',
                    'label' => 'EenPartnershipProposal',
                    'status_attribute' => 'status',
                    'status_value' => '',
                    'created_at' => $now,
                    'updated_at' => $now,
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
            } catch (\Exception $exception) {
                MigrationCommon::printConsoleMessage('Errore durante inserimento configurazione cwh config contents per EEN');
                MigrationCommon::printConsoleMessage('Code: ' . $exception->getCode() . '; Line: ' . $exception->getLine());
                MigrationCommon::printConsoleMessage($exception->getMessage());
                MigrationCommon::printConsoleMessage($exception->getTrace());
                return false;
            }
            MigrationCommon::printConsoleMessage('Configurazione cwh config contents per EEN creata correttamente');
        } else {
            MigrationCommon::printConsoleMessage('Configurazione cwh config contents per EEN esistente');
        }
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m201217_105208_add_arter_een_cwh_config_contents cannot be reverted.\n";
        return false;
    }
}
