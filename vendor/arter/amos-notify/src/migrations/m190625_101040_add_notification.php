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

class m190625_101040_add_notification extends Migration
{
    const TABLE = 'notification';

    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'record_id' ,$this->integer()->defaultValue(null)->after('class_name')->comment('Record id'));
        $this->addColumn(self::TABLE, 'models_classname_id' ,$this->integer()->defaultValue(null)->after('class_name')->comment('Scope pubblication'));
        $this->addForeignKey('fk_notification_models_classname_id', self::TABLE, 'models_classname_id', 'models_classname', 'id');
    }

    public function safeDown()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS =0");
        $this->addColumn(self::TABLE, 'record_id' ,$this->integer()->defaultValue(null)->after('class_name')->comment('Recordi id'));
        $this->addColumn(self::TABLE, 'models_classname_id' ,$this->integer()->defaultValue(null)->after('class_name')->comment('Scope pubblication'));
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');

    }
}
