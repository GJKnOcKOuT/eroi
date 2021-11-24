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

class m150625_000001_update_audit_entry extends \yii\db\Migration
{
    const TABLE = '{{%audit_entry}}';

    public function up()
    {
        $this->dropColumn(self::TABLE, 'url');
        $this->dropColumn(self::TABLE, 'redirect');
        $this->dropColumn(self::TABLE, 'referrer');
        $this->alterColumn(self::TABLE, 'route', Schema::TYPE_STRING . '(512)');
        $this->alterColumn(self::TABLE, 'request_method', Schema::TYPE_STRING . '(16)');
    }

    public function down()
    {
        $this->addColumn(self::TABLE, 'url', Schema::TYPE_STRING . '(255)');
        $this->addColumn(self::TABLE, 'redirect', Schema::TYPE_STRING . '(255)');
        $this->addColumn(self::TABLE, 'referrer', Schema::TYPE_STRING . '(255)');
        $this->alterColumn(self::TABLE, 'route', Schema::TYPE_STRING . '(255)');
        $this->alterColumn(self::TABLE, 'request_method', Schema::TYPE_STRING . '(255)');
    }
}
