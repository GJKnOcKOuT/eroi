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
 * @package    arter\amos\sondaggi\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\sondaggi\models\Sondaggi;
use yii\db\Migration;

/**
 * Class m180907_131126_alter_sondaggi_table_add_status_column
 */
class m180907_131126_alter_sondaggi_table_add_status_column extends Migration
{
    private $tableName;
    private $fieldNameName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = Sondaggi::tableName();
        $this->fieldNameName = 'status';
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, $this->fieldNameName, $this->string(255)->null()->defaultValue(null)->after('id')->comment('Status'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, $this->fieldNameName);
        return true;
    }
}
