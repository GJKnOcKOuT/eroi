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
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\organizzazioni\models\base\ProfiloEntiType;
use yii\db\Migration;

/**
 * Class m190509_173500_add_column_priority_rows_profilo_enti_type
 */
class m190509_173500_add_column_priority_rows_profilo_enti_type extends Migration
{
    private $tableName = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = ProfiloEntiType::tableName();
    }

    public function safeUp()
    {
        $this->addColumn($this->tableName, 'priority', $this->integer()->after('name')->defaultValue(0)->comment('Order priority inside select html'));

        return true;
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'priority');

        return true;
    }
}