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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;
use yii\db\Schema;

class m160831_161808_create_dashboard_users extends Migration
{
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%amos_user_dashboards}}', [
            'id' => $this->primaryKey(),
            'user_id' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'module' => Schema::TYPE_STRING . '(32) NOT NULL',
            'slide' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT 1',
            'created_by' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'created_at' => Schema::TYPE_DATETIME . '  NULL DEFAULT NULL',
            'updated_by' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'updated_at' => Schema::TYPE_DATETIME . '  NULL DEFAULT NULL',
            'deleted_by' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'deleted_at' => Schema::TYPE_DATETIME . '  NULL DEFAULT NULL',
        ], $tableOptions);

        $this->createTable('{{%amos_user_dashboards_widget_mm}}', [
            'amos_user_dashboards_id' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'amos_widgets_classname' => Schema::TYPE_STRING . ' NOT NULL',
            'order' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT 1',
        ], $tableOptions);

        $this->addPrimaryKey('amos_user_dashboards_widget_mm-pk', '{{%amos_user_dashboards_widget_mm}}', ['amos_user_dashboards_id', 'amos_widgets_classname']);

        $this->addForeignKey('fk_amos_widgets_classname', '{{%amos_user_dashboards_widget_mm}}', 'amos_widgets_classname', 'amos_widgets', 'classname');
        $this->addForeignKey('fk_amos_user_dashboards_id', '{{%amos_user_dashboards_widget_mm}}', 'amos_user_dashboards_id', 'amos_user_dashboards', 'id');


        return true;

    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->dropTable('{{%amos_user_dashboards}}');
        $this->dropTable('{{%amos_user_dashboards_widget_mm}}');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
        return true;
    }

}
