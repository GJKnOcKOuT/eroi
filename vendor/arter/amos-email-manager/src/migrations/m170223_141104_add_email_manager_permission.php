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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170223_141104_add_email_manager_permission
 */
class m170223_141104_add_email_manager_permission extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = array_merge(
            $this->setEmailTemplateModelPermissions(),
            $this->setEmailSpoolModelPermissions()
        );
    }

    /**
     * ADMINISTRATOR PLUGIN Email manager and template model permission
     *
     * @return array
     */
    private function setEmailTemplateModelPermissions()
    {
        return [
            [
                'name' => 'AMMINISTRATORE_EMAIL_MANAGER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo di amministratore email',
                'ruleName' => null
            ],
            [
                'name' => 'EMAILTEMPLATE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model EmailTemplate',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ],
            [
                'name' => 'EMAILTEMPLATE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model EmailTemplate',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ],
            [
                'name' => 'EMAILTEMPLATE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model EmailTemplate',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ],
            [
                'name' => 'EMAILTEMPLATE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model EmailTemplate',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ]
        ];
    }

    /**
     * Email spool model permissions
     *
     * @return array
     */
    private function setEmailSpoolModelPermissions()
    {
        return [
            [
                'name' => 'EMAILSPOOL_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model EmailSpool',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ],
            [
                'name' => 'EMAILSPOOL_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model EmailSpool',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ],
            [
                'name' => 'EMAILSPOOL_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model EmailSpool',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ],
            [
                'name' => 'EMAILSPOOL_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model EmailSpool',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_EMAIL_MANAGER']
            ]
        ];
    }
}
