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
 * @package    arter\amos\organizzazioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m171213_081930_remove_fileds_profilo extends Migration
{

    const TABLE_PROFILO = '{{%profilo}}';

    public function safeUp()
    {
        $table = \Yii::$app->db->schema->getTableSchema(self::TABLE_PROFILO);
        if(isset($table->columns['logo'])) {
            $this->dropColumn(self::TABLE_PROFILO, 'logo');
        }
        if(isset($table->columns['allegati'])) {
            $this->dropColumn(self::TABLE_PROFILO, 'allegati');
        }
        if(isset($table->columns['ambiti_tecnologici_su_cui_siet'])) {
            $this->dropColumn(self::TABLE_PROFILO, 'ambiti_tecnologici_su_cui_siet');
        }
        if(isset($table->columns['principali_ambiti_di_attivita_organizzazione'])) {
            $this->dropColumn(self::TABLE_PROFILO, 'principali_ambiti_di_attivita_organizzazione');
        }

        return true;
    }

    public function safeDown()
    {
        $table = \Yii::$app->db->schema->getTableSchema(self::TABLE_PROFILO);
        if(!isset($table->columns['logo'])) {
            $this->addColumn(self::TABLE_PROFILO, 'logo',Schema::TYPE_STRING . "(255) NULL COMMENT 'Logo'");
        }
        if(!isset($table->columns['allegati'])) {
            $this->addColumn(self::TABLE_PROFILO, 'allegati',Schema::TYPE_STRING . "(255) NULL COMMENT 'Allegati'");
        }
        if(!isset($table->columns['ambiti_tecnologici_su_cui_siet'])) {
            $this->addColumn(self::TABLE_PROFILO, 'ambiti_tecnologici_su_cui_siet',Schema::TYPE_STRING . "(255) NULL COMMENT 'Ambiti tecnologici su cui siete interessati a'");
        }
        if(!isset($table->columns['principali_ambiti_di_attivita_organizzazione'])) {
            $this->addColumn(self::TABLE_PROFILO, 'principali_ambiti_di_attivita_organizzazione',Schema::TYPE_STRING . "(255) NULL COMMENT 'Principali ambiti di attività in cui opera la'");
        }

        return true;
    }


}
