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

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m181023_153000_add_widget_permissions
 */
class m181023_153000_add_widget_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketDashboard',
                'ruleName' => null,
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketFaq::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketFaq',
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketWaiting::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketWaiting',
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketProcessing::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketProcessing',
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketClosed::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketClosed',
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketAll::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketAll',
                'parent' => ['OPERATORE_TICKET']
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketCategorie::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketCategorie',
                'parent' => ['REFERENTE_TICKET']
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketAdminFaq::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketAdminFaq',
                'parent' => ['REFERENTE_TICKET']
            ],
        ];
    }
}
