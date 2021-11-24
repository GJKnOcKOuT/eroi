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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\videoconference\models\Videoconf;
use yii\db\Migration;

/**
 * Class m171219_111336_add_community_field_hits
 */
class m180110_095836_add_columns_ore extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(Videoconf::tableName(), 'reminder_sent', $this->integer(1)->defaultValue(0)->after('begin_date_hour'));
        $this->addColumn(Videoconf::tableName(), 'notification_before_conference', $this->integer()->defaultValue(null)->after('begin_date_hour'));
        $this->addColumn(Videoconf::tableName(), 'end_date_hour', $this->datetime()->defaultValue(null)->after('begin_date_hour'));


    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(Videoconf::tableName(), 'notification_before_conference');
        $this->dropColumn(Videoconf::tableName(), 'end_date_hour');
    }
}
