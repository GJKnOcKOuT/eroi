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
 * @package    arter\amos\notify\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\notificationmanager\models\NotificationConf;
use yii\db\Migration;

/**
 * Class m201023_104757_add_notificationconf_field_2
 */
class m201023_104757_add_notificationconf_field_2 extends Migration
{
    private $tableName;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->tableName = NotificationConf::tableName();
    }
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'notify_newsletter', $this->boolean()->null()->defaultValue(1)->after('notify_ticket_faq_referee'));
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'notify_newsletter');
        return true;
    }
}
