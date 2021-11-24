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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\notificationmanager\rules\DeleteOwnNewsletterRule;
use arter\amos\notificationmanager\rules\UpdateOwnNewsletterRule;
use arter\amos\notificationmanager\widgets\icons\WidgetIconNewsletterAll;
use arter\amos\notificationmanager\widgets\icons\WidgetIconNewsletterCreatedBy;
use arter\amos\notificationmanager\widgets\icons\WidgetIconNewsletterDashboard;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m200428_162835_newsletter_permissions
 */
class m200428_162835_newsletter_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(),
            $this->setModelPermissions(),
            $this->setWidgetsPermissions()
        );
    }
    
    private function setPluginRoles()
    {
        return [
            [
                'name' => 'NOTIFY_ADMINISTRATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for notify plugin',
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'NEWSLETTER_ADMINISTRATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for newsletter',
                'parent' => ['NOTIFY_ADMINISTRATOR']
            ],
            [
                'name' => 'NEWSLETTER_MANAGER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Manager role for newsletter',
                'parent' => ['NEWSLETTER_ADMINISTRATOR']
            ]
        ];
    }
    
    private function setModelPermissions()
    {
        return [
            [
                'name' => 'NEWSLETTER_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Create permission for model Newsletter',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
            [
                'name' => 'NEWSLETTER_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Read permission for model Newsletter',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
            [
                'name' => 'NEWSLETTER_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Newsletter',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', UpdateOwnNewsletterRule::className()]
            ],
            [
                'name' => 'NEWSLETTER_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Delete permission for model Newsletter',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', DeleteOwnNewsletterRule::className()]
            ],
            [
                'name' => UpdateOwnNewsletterRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Rule to update own newsletters',
                'ruleName' => UpdateOwnNewsletterRule::className(),
                'parent' => ['NEWSLETTER_MANAGER']
            ],
            [
                'name' => DeleteOwnNewsletterRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Rule to delete own newsletters',
                'ruleName' => DeleteOwnNewsletterRule::className(),
                'parent' => ['NEWSLETTER_MANAGER']
            ],
        ];
    }
    
    private function setWidgetsPermissions()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => WidgetIconNewsletterDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconNewsletterDashboard',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
            [
                'name' => WidgetIconNewsletterAll::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconNewsletterAll',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
            [
                'name' => WidgetIconNewsletterCreatedBy::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconNewsletterCreatedBy',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
        ];
    }
}
