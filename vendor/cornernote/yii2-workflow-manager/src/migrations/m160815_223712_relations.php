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


use yii\db\Schema;
use yii\db\Migration;

class m160815_223712_relations extends Migration
{

    public function safeUp()
    {
        //$this->addForeignKey('fk_sw_status_workflow_id', '{{%sw_status}}', 'workflow_id', 'sw_workflow', 'id');
        //$this->addForeignKey('fk_sw_transition_workflow_id', '{{%sw_transition}}', 'workflow_id', 'sw_workflow', 'id');
        //$this->addForeignKey('fk_sw_transition_start_status_id', '{{%sw_transition}}', 'start_status_id', 'sw_status', 'id');
        //$this->addForeignKey('fk_sw_transition_end_status_id', '{{%sw_transition}}', 'end_status_id', 'sw_status', 'id');
        //$this->addForeignKey('fk_sw_workflow_initial_status_id', '{{%sw_workflow}}', 'initial_status_id', 'sw_status', 'id');
        //$this->addForeignKey('fk_sw_metadata_status_id', '{{%sw_metadata}}', 'status_id', 'sw_status', 'id');
        //$this->addForeignKey('fk_sw_metadata_workflow_id', '{{%sw_metadata}}', 'workflow_id', 'sw_workflow', 'id');
    }

    public function safeDown()
    {
        //$this->dropForeignKey('fk_sw_status_workflow_id', '{{%sw_status}}');
        //$this->dropForeignKey('fk_sw_transition_workflow_id', '{{%sw_transition}}');
        //$this->dropForeignKey('fk_sw_transition_start_status_id', '{{%sw_transition}}');
        //$this->dropForeignKey('fk_sw_transition_end_status_id', '{{%sw_transition}}');
        //$this->dropForeignKey('fk_sw_workflow_initial_status_id', '{{%sw_workflow}}');
        //$this->dropForeignKey('fk_sw_metadata_status_id', '{{%sw_metadata}}');
        //$this->dropForeignKey('fk_sw_metadata_workflow_id', '{{%sw_metadata}}');
    }

}
