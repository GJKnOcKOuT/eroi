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

/**
 * Class m171212_090001_alter_table_amos_widgets
 */
class m171212_090001_alter_table_amos_widgets extends Migration
{
    const TABLE = '{{%amos_widgets}}';
    private $tableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->tableName = $this->db->getSchema()->getRawTableName(self::TABLE);
    }

    /**
     * Use this instead of function up().
     * @see \Yii\db\Migration::safeUp() for more info.
     */
    public function safeUp()
    {
        try {
            $this->addColumn($this->tableName, 'sub_dashboard', Schema::TYPE_INTEGER . " NOT NULL DEFAULT 0 AFTER dashboard_visible");
            $this->update($this->tableName, ['created_at' => date('Y-m-d')], "created_at is null");

        } catch (Exception $e) {
            echo "Errore durante la modifica della tabella " . $this->tableName . "\n";
            echo $e->getMessage() . "\n";
            return false;
        }
        return true;
    }

    /**
     * Use this instead of function down().
     * @see \Yii\db\Migration::safeDown() for more info.
     */
    public function safeDown()
    {
        try {
            $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
            $this->dropColumn(self::TABLE, 'sub_dashboard');
            $this->dropColumn(self::TABLE, 'id');
            $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
        } catch (Exception $e) {
            echo "Errore durante il revert della modifica della tabella " . $this->tableName . "\n";
            echo $e->getMessage() . "\n";
            return false;
        }

        return true;
    }
}
