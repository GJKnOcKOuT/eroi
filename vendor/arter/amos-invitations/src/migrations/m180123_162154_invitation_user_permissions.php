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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
* Class m180123_162154_invitation_user_permissions*/
class m180123_162154_invitation_user_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
//                [
//                    'name' =>  'INVITATIONUSER_CREATE',
//                    'type' => Permission::TYPE_PERMISSION,
//                    'description' => 'Permesso di CREATE sul model InvitationUser',
//                    'ruleName' => null,
//                    'parent' => ['ADMIN']
//                ],
//                [
//                    'name' =>  'INVITATIONUSER_READ',
//                    'type' => Permission::TYPE_PERMISSION,
//                    'description' => 'Permesso di READ sul model InvitationUser',
//                    'ruleName' => null,
//                    'parent' => ['ADMIN']
//                    ],
//                [
//                    'name' =>  'INVITATIONUSER_UPDATE',
//                    'type' => Permission::TYPE_PERMISSION,
//                    'description' => 'Permesso di UPDATE sul model InvitationUser',
//                    'ruleName' => null,
//                    'parent' => ['ADMIN']
//                ],
//                [
//                    'name' =>  'INVITATIONUSER_DELETE',
//                    'type' => Permission::TYPE_PERMISSION,
//                    'description' => 'Permesso di DELETE sul model InvitationUser',
//                    'ruleName' => null,
//                    'parent' => ['ADMIN']
//                ],
            ];
    }
}
