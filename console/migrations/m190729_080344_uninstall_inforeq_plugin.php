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

use arter\amos\dashboard\models\AmosWidgets;
use yii\db\Migration;

/**
 * Class m190729_080344_uninstall_inforeq_plugin
 */
class m190729_080344_uninstall_inforeq_plugin extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->execute("SET foreign_key_checks = 0;");

        $inforeqTable = 'inforeq';
        if ($this->db->schema->getTableSchema($inforeqTable, true) !== null) {
            $this->dropTable($inforeqTable);
        }

        $inforeqArgomentiTable = 'inforeq_argomenti';
        if ($this->db->schema->getTableSchema($inforeqArgomentiTable, true) !== null) {
            $this->dropTable($inforeqArgomentiTable);
        }

        $moduleName = 'inforeq';
        $this->delete(AmosWidgets::tableName(), ['and',
            ['like', 'classname', "arter\amos\inforeq\widgets\icons\WidgetIconInforeq"],
            ['like', 'module', $moduleName]
        ]);
        $this->delete(AmosWidgets::tableName(), ['and',
            ['like', 'classname', "arter\amos\inforeq\widgets\icons\WidgetIconInforeqAdmin"],
            ['like', 'module', $moduleName]
        ]);

        $this->delete('auth_assignment', ['like', 'item_name', 'inforeq']);
        $this->delete('tag_models_auth_items_mm', ['like', 'auth_item', 'inforeq']);
        $this->delete('cwh_tag_interest_mm', ['like', 'auth_item', 'inforeq']);
        $this->delete('migration', ['like', 'version', 'inforeq']);

        $this->execute("SET foreign_key_checks = 1;");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190729_080344_uninstall_inforeq_plugin cannot be reverted.\n";
        return false;
    }
}
