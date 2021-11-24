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


use arter\amos\events\models\Event;
use yii\db\Migration;

/**
 * Class m200204_182830_add_columns_event_3
 */
class m200205_162530_add_columns_calendar_slots extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('event_calendars_slots', 'cellphone', $this->string()->after('user_id'));
        $this->addColumn('event_calendars_slots', 'affiliation', $this->string()->after('user_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('event_calendars_slots', 'cellphone');
        $this->dropColumn('event_calendars_slots', 'affiliation');
    }
}