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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m160926_171930_cwh_tag_interest_mm extends Migration
{
    const TABLE = "cwh_tag_interest_mm";

    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'tag_id' => $this->integer(11)->notNull()->comment('Root'),
            'classname' => $this->string(255)->notNull()->comment('Model'),
            'auth_item' => $this->string(255)->notNull()->comment('Item'),
        ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);

        $this->addPrimaryKey('pk_cwh_tag_interest_mm_id', self::TABLE, 'tag_id, classname, auth_item');

        if(Yii::$app->db->schema->getTableSchema('tag') !== null) { // IF tag table exists
            $this->addForeignKey('fk_cwh_tag_interest_mm_tag_id', self::TABLE, 'tag_id', 'tag', 'id');
        }

        $this->addForeignKey('fk_cwh_tag_interest_mm_auth_item', self::TABLE, 'auth_item', 'auth_item', 'name');

        return true;
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE);
        return true;
    }
}
