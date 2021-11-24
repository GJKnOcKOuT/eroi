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

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\notificationmanager\models\Newsletter;
use yii\rbac\Permission;

/**
 * Class m200508_163240_newsletter_workflow_permissions
 */
class m200508_163240_newsletter_workflow_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => Newsletter::WORKFLOW_STATUS_DRAFT,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow Newsletter: Bozza',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
            [
                'name' => Newsletter::WORKFLOW_STATUS_WAIT_SEND,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow Newsletter: In attesa di invio',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
            [
                'name' => Newsletter::WORKFLOW_STATUS_WAIT_RESEND,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow Newsletter: In attesa di reinvio',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ],
            [
                'name' => Newsletter::WORKFLOW_STATUS_SENT,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow Newsletter: Inviata',
                'parent' => ['NEWSLETTER_ADMINISTRATOR', 'NEWSLETTER_MANAGER']
            ]
        ];
    }
}
