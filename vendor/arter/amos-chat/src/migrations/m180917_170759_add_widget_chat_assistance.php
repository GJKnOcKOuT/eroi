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
 * @package    arter\amos\chat\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m180917_170759_add_widget_chat_assistance
 */
class m180917_170759_add_widget_chat_assistance extends AmosMigrationWidgets
{

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\chat\widgets\icons\WidgetIconChatAssistance::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => 'chat',
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'default_order' => 55,
                'dashboard_visible' => 0,
            ]
        ];
    }
}
