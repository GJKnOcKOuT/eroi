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
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigration;
use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard;

/**
 * Class m190205_184632_update_widget_ticket
 */
class m190205_184632_update_widget_ticket extends AmosMigration
{
    const MODULE_NAME = 'ticket';
    const COMMUNITY_MODULE_NAME = 'community';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('amos_widgets', [
            'classname' => WidgetIconTicketDashboard::className(),
            'type' => AmosWidgets::TYPE_ICON,
            'module' => self::COMMUNITY_MODULE_NAME,
            'status' => AmosWidgets::STATUS_ENABLED,
            'default_order' => 150,
            'sub_dashboard' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('amos_widgets', [
            'classname' => WidgetIconTicketDashboard::className(),
            'type' => AmosWidgets::TYPE_ICON,
            'module' => self::COMMUNITY_MODULE_NAME,
            'status' => AmosWidgets::STATUS_ENABLED,
            'default_order' => 150,
            'sub_dashboard' => 1,
        ]);
        return true;
    }
}
