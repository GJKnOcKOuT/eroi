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

use arter\amos\partnershipprofiles\models\base\DevelopmentStage;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m190508_183600_add_column_priority_development_stage
 */
class m190508_183600_add_column_priority_development_stage extends Migration
{
    const ADMIN_ID = 1;

    private $tableName = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = DevelopmentStage::tableName();
    }

    public function safeUp()
    {
        $this->addColumn($this->tableName, 'priority', $this->integer(1)->after('value')->defaultValue(0)->comment('Order priority inside select html'));

        return true;
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'priority');

        return true;
    }
}