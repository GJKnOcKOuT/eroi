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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigration;

/**
 * Class m160930_143930_create_amoschat_message_table
 */
class m160930_143930_create_amoschat_message_table extends AmosMigration
{
    const TABLE_USER = '{{%user}}';
    const TABLE_USER_PROFILE = '{{%user_profile}}';
    const TABLE_MESSAGE = '{{%amoschat_message}}';

    /**
     * Use this instead of function up().
     * @see \Yii\db\Migration::safeUp() for more info.
     */
    public function safeUp()
    {
        $tableName = $this->db->getSchema()->getRawTableName(self::TABLE_MESSAGE);

        if ($this->db->schema->getTableSchema(self::TABLE_MESSAGE, true) === null) {
            try {
                $this->createTable(self::TABLE_MESSAGE, [
                    'id' => $this->bigPrimaryKey()->unsigned(),
                    'sender_id' => $this->integer()->notNull(),
                    'receiver_id' => $this->integer()->notNull(),
                    'text' => $this->text()->notNull(),
                    'is_new' => $this->boolean()->defaultValue(true),
                    'is_deleted_by_sender' => $this->boolean()->defaultValue(false),
                    'is_deleted_by_receiver' => $this->boolean()->defaultValue(false),
                    'created_at' => $this->dateTime()->notNull(),
                    'updated_at' => $this->dateTime()->null()->defaultValue(null),
                    'deleted_at' => $this->dateTime()->null()->defaultValue(null),
                    'created_by' => $this->integer()->null()->defaultValue(null),
                    'updated_by' => $this->integer()->null()->defaultValue(null),
                    'deleted_by' => $this->integer()->null()->defaultValue(null),
                ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);
                $this->addForeignKey('fk_' . $tableName . '_sender_id', self::TABLE_MESSAGE, 'sender_id', 'user', 'id');
                $this->addForeignKey('fk_' . $tableName . '_receiver_id', self::TABLE_MESSAGE, 'receiver_id', 'user', 'id');
            } catch (Exception $e) {
                echo "Errore durante la creazione della tabella " . $tableName . "\n";
                echo $e->getMessage() . "\n";
                return false;
            }
        } else {
            echo "Nessuna creazione eseguita in quanto la tabella " . $tableName . " esiste gia'\n";
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
            $this->dropTable(self::TABLE_MESSAGE);
        } catch (Exception $e) {
            echo "Errore durante la cancellazione della tabella " . self::TABLE_MESSAGE . "\n";
            echo $e->getMessage() . "\n";
            return false;
        }
        return true;
    }
}
