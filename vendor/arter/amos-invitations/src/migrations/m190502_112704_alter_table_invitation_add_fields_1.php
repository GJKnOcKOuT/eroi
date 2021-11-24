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
 * @package    arter\amos\invitations\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\invitations\models\Invitation;
use yii\db\Migration;

/**
 * Class m190502_112704_alter_table_invitation_add_fields_1
 */
class m190502_112704_alter_table_invitation_add_fields_1 extends Migration
{
    private $tableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->tableName = Invitation::tableName();
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'module_name', $this->string(255)->null()->defaultValue(null)->after('send'));
        $this->addColumn($this->tableName, 'context_model_id', $this->integer()->null()->defaultValue(null)->after('module_name'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'module_name');
        $this->dropColumn($this->tableName, 'context_model_id');
        return true;
    }
}
