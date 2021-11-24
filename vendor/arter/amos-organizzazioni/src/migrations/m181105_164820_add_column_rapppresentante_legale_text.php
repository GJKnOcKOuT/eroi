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
 * @package    arter\amos\organizzazioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\organizzazioni\models\Profilo;
use yii\db\Migration;

/**
 * Class m181011_090220_create_table_profilo_enti_type
 */
class m181105_164820_add_column_rapppresentante_legale_text extends Migration
{
    private $tableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = Profilo::tableName();
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $table = \Yii::$app->db->schema->getTableSchema($this->tableName);
        if (!isset($table->columns['rappresentante_legale_text'])) {
            $this->addColumn($this->tableName, 'rappresentante_legale_text', $this->string()->after('rappresentante_legale')->comment('Rappresentante legale text'));
        }
        
        $this->alterColumn($this->tableName, 'rappresentante_legale', $this->string()->defaultValue(null));
        $this->update($this->tableName, ['rappresentante_legale' => null], ['rappresentante_legale' => '']);
        $this->alterColumn($this->tableName, 'rappresentante_legale', $this->integer()->defaultValue(null)->comment('Rappresentante legale'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'rappresentante_legale_text');
        $this->alterColumn($this->tableName, 'rappresentante_legale', $this->integer()->notNull()->comment('Rappresentante legale'));
        return true;
    }
}
