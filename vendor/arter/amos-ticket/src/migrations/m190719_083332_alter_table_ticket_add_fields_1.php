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
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\ticket\models\Ticket;
use yii\db\Migration;

/**
 * Class m190719_083332_alter_table_ticket_add_fields_1
 */
class m190719_083332_alter_table_ticket_add_fields_1 extends Migration
{
    private $tableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = Ticket::tableName();
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'dossier_id', $this->string(50)->null()->defaultValue(null)->after('organization_name'));
        $this->addColumn($this->tableName, 'phone', $this->string(50)->null()->defaultValue(null)->after('dossier_id'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'dossier_id');
        $this->dropColumn($this->tableName, 'phone');
        return true;
    }
}
