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


use yii\db\Migration;

class m200429_131015_add_column_pc extends Migration
{
    const TABLE_NAME = '{{%bullet_counters}}';

    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        $this->addColumn(self::TABLE_NAME, 'pre_counter', $this->integer()->defaultValue(0)->after('counter'));
    }

    public function down()
    {
        $this->dropColumn(self::TABLE_NAME, 'pre_counter');
    }
}