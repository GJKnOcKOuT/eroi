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
 * Class m200204_182730_add_columns_event_3
 */
class m200204_182730_add_columns_event_3 extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('event', 'thank_you_page_already_registered_view',
            $this->string()->comment('Thank you page custom in caso di utente già registrato')->after('thank_you_page_view'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('event', 'thank_you_page_already_registered_view');
    }
}