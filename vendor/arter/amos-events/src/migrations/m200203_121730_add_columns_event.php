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
 * Class m200203_121730_add_columns_event
 */
class m200203_121730_add_columns_event extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('event', 'sent_credential',
            $this->integer()->comment('Sent credential')->after('ticket_layout_view'));
        $this->addColumn('event', 'email_credential_view',
            $this->string()->comment('Sent credential')->after('email_subscribe_view'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('event', 'sent_credential');
        $this->dropColumn('event', 'email_credential_view');
    }
} 