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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\events\models\EventType;
use yii\db\Migration;

/**
 * Class m190326_171833_add_event_types_field_enabled
 */
class m190326_171833_add_event_types_field_enabled extends Migration
{
    private $tableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = EventType::tableName();
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'enabled', $this->boolean()->notNull()->defaultValue(1)->after('logoRequested'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'enabled');
        return true;
    }
}
