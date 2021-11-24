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
 * Class m191025_084530_add_column_custom
 */
class m191025_084530_add_column_custom extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('event', 'email_ticket_layout_custom',
            $this->text()->defaultValue(null)->comment('Email ticket layout')->after('email_subscribe_view'));
        $this->addColumn('event', 'email_ticket_sender',
            $this->text()->defaultValue(null)->comment('Email ticket sender')->after('email_ticket_layout_custom'));
        $this->addColumn('event', 'email_ticket_subject',
            $this->text()->defaultValue(null)->comment('Email ticket subject')->after('email_ticket_sender'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('event', 'email_ticket_subject');
        $this->dropColumn('event', 'email_ticket_sender');
        $this->dropColumn('event', 'email_ticket_layout_custom');
    }
}