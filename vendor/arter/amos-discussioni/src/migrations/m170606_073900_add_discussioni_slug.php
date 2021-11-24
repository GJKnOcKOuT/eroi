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


use arter\amos\discussioni\models\DiscussioniTopic;

use yii\db\Migration;

class m170606_073900_add_discussioni_slug extends Migration
{
    private 
        $tableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = DiscussioniTopic::tableName();
        
    }

    /**
     * @inheritdoc
     * @return boolean
     */
    public function safeUp()
    {
        $table = $this->db->getTableSchema($this->tableName);
        if (!isset($table->columns['slug'])) {
            $this->addColumn(
                $this->tableName,
                'slug',
                $this->text()->null()->after('id')
            );
        }
        
        if (!isset($table->columns['close_comment_thread'])) {
            $this->addColumn(
                $this->tableName, 
                'close_comment_thread', 
                $this->boolean()->notNull()->defaultValue(0)->comment('Close discussion')->after('slug')
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return boolean
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName(), 'slug');
        $this->dropColumn($this->tableName(), 'close_comment_thread');

        return true;
    }
}
