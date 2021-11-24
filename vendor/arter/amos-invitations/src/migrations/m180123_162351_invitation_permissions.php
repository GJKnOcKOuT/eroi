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
 * Class m180123_162351_invitation_permissions*/
class m180123_162351_invitation_permissions extends AmosMigrationPermissions
{

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'INVITATIONS_ADMINISTRATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruole adiminstrator',
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'INVITATIONS_BASIC_USER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruole adiminstrator',
                'parent' => ['VALIDATED_BASIC_USER']
            ],
            [
                'name' => 'INVITATION_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model Invitation',
                'parent' => ['INVITATIONS_ADMINISTRATOR', 'INVITATIONS_BASIC_USER']
            ],
            [
                'name' => 'INVITATION_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model Invitation',
                'parent' => ['INVITATIONS_ADMINISTRATOR']
            ],
            [
                'name' => 'INVITATION_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model Invitation',
                'parent' => ['INVITATIONS_ADMINISTRATOR']
            ],
            [
                'name' => \arter\amos\invitations\rules\ReadOwnInvitationRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model Invitation',
                'ruleName' => \arter\amos\invitations\rules\ReadOwnInvitationRule::className(),
                'parent' => ['INVITATIONS_BASIC_USER'],
                'children' => ['INVITATION_READ']
            ],
            [
                'name' => \arter\amos\invitations\rules\UpdateOwnInvitationRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model Invitation',
                'ruleName' => \arter\amos\invitations\rules\UpdateOwnInvitationRule::className(),
                'parent' => ['INVITATIONS_BASIC_USER'],
                'children' => ['INVITATION_UPDATE']
            ],
        ];
    }
}
