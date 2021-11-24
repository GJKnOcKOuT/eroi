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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\models\Community;
use yii\db\Migration;

/**
 * Class m190607_152618_add_discussion_close_discussion
 */
class m190607_152618_add_discussion_close_discussion extends Migration
{
    private 
        $tableName,
        $fieldName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = \arter\amos\discussioni\models\DiscussioniTopic::tableName();
        $this->fieldName = 'close_comment_thread';
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $table = $this->db->getTableSchema($this->tableName);
        if (!isset($table->columns[$this->fieldName])) {
            $this->addColumn($this->tableName, $this->fieldName, $this->boolean()->notNull()->defaultValue(0)->comment('Close discussion'));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, $this->fieldName);
        return true;
    }
}
