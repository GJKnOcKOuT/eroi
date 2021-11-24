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
 * Class m190523_191530_alter_table_event
 */
class m190523_191530_alter_table_event extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Event::tableName(), 'event_closed_page_view', $this->string(400)->null()->comment('Event closed page view')->after('email_view'));
        $this->addColumn(Event::tableName(), 'event_full_page_view', $this->string(400)->null()->comment('Event full page view')->after('event_closed_page_view'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Event::tableName(), 'event_closed_page_view');
        $this->dropColumn(Event::tableName(), 'event_full_page_view');
    }

}
