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
 * Class m190326_155518_fix_event_types_values
 */
class m190326_155518_fix_event_types_values extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update(EventType::tableName(), ['event_context_id' => 1], ['event_context_id' => null]);
        $this->update(EventType::tableName(), ['created_by' => 1], ['created_by' => null]);
        $this->update(EventType::tableName(), ['updated_by' => 1], ['updated_by' => null]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190326_155518_fix_event_types_values cannot be reverted.\n";
        return false;
    }
}
