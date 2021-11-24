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

use yii\db\Schema;
use yii\db\Migration;

class m130524_201642_dashboard_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%amos_widgets}}', [
            'classname' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => Schema::TYPE_STRING . '(32) NOT NULL',
            'module' => Schema::TYPE_STRING . '(32) NOT NULL',
            'status' => Schema::TYPE_INTEGER . '(1) NULL DEFAULT 1',
            'created_by' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'created_at' => Schema::TYPE_DATETIME . '  NULL DEFAULT NULL',
            'updated_by' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'updated_at' => Schema::TYPE_DATETIME . '  NULL DEFAULT NULL',
            'deleted_by' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'deleted_at' => Schema::TYPE_DATETIME . '  NULL DEFAULT NULL',
        ], $tableOptions);

        $this->addPrimaryKey('classname', '{{%amos_widgets}}', 'classname');
    }

    public function down()
    {
        $this->dropTable('{{%amos_widgets}}');
    }

}
