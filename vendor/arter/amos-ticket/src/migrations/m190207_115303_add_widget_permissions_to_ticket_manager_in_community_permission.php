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

use arter\amos\ticket\widgets\icons\WidgetIconTicketAdminFaq;
use arter\amos\ticket\widgets\icons\WidgetIconTicketCategorie;
use yii\rbac\Permission;

/**
 * Class m190207_115303_add_widget_permissions_to_ticket_manager_in_community_permission
 */
class m190207_115303_add_widget_permissions_to_ticket_manager_in_community_permission extends \arter\amos\core\migration\AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => WidgetIconTicketCategorie::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketCategorie',
                'parent' => ['TICKET_MANAGER_FOR_COMMUNITY']
            ],
            [
                'name' => WidgetIconTicketAdminFaq::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconTicketAdminFaq',
                'parent' => ['TICKET_MANAGER_FOR_COMMUNITY']
            ]
        ];
    }
}
