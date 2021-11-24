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
 * @package    arter\amos\organizzazioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\organizzazioni\rules\AssociateProfiloUserToOrganizationsRule;
use yii\rbac\Permission;

/**
 * Class m191209_115333_modify_add_user_to_organization_permission
 */
class m191209_115333_modify_add_user_to_organization_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => AssociateProfiloUserToOrganizationsRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per ruolo responsabile di struttura di modificare le organizzazioni per cui è referente operativo',
                'ruleName' => AssociateProfiloUserToOrganizationsRule::className(),
                'parent' => [
                    'USERPROFILE_UPDATE'
                ],
                'children' => [
                    'ASSOCIATE_ORGANIZZAZIONI_TO_USER'
                ]
            ],
            [
                'name' => 'ASSOCIATE_ORGANIZZAZIONI_TO_USER',
                'update' => true,
                'newValues' => [
                    'addParents' => ['AMMINISTRATORE_ORGANIZZAZIONI'],
                    'removeParents' => ['USERPROFILE_UPDATE']
                ]
            ]
        ];
    }
}
