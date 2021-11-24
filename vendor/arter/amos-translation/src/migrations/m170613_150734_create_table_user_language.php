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
 * @package    arter\amos\translation\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * Class m170613_150734_create_table_user_language
 */
class m170613_150734_create_table_user_language extends \yii\db\Migration
{
    const TABLE = '{{%translation_user_language_mm}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableName = $this->db->getSchema()->getRawTableName(self::TABLE);

        if ($this->db->schema->getTableSchema(self::TABLE, true) === null) {
            try {
                $this->createTable(self::TABLE, [
                    'user_id' => $this->integer()->notNull(),
                    'language' => $this->string()->notNull(),
                    'created_at' => $this->dateTime()->null(),
                    'updated_at' => $this->dateTime()->null(),
                    'deleted_at' => $this->dateTime()->null(),
                    'created_by' => $this->integer()->null(),
                    'updated_by' => $this->integer()->null(),
                    'deleted_by' => $this->integer()->null(),
                ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
                $this->addPrimaryKey('pk_' . $tableName, self::TABLE, ['user_id', 'language']);
                $this->addForeignKey('fk_' . $tableName . '_user_idTr1', self::TABLE, 'user_id', 'user', 'id');
                $this->addForeignKey('fk_' . $tableName . '_languageTr2', self::TABLE, 'language', 'language', 'language_id');
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
     * @inheritdoc
     */
    public function safeDown()
    {
        try {
            $this->dropTable(self::TABLE);
        } catch (Exception $e) {
            echo "Errore durante la cancellazionedella tabella " . self::TABLE . "\n";
            echo $e->getMessage() . "\n";
            return false;
        }

        return true;
    }
}
