<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
 * Class m180125_122615_add_auth_item_invitations*/
class m180125_122615_add_auth_item_invitations extends AmosMigrationPermissions
{

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';

        return [
            [
                'name' =>  \arter\amos\invitations\widgets\icons\WidgetIconInvitations::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconInvitations',
                'ruleName' => null,
                'parent' => ['INVITATIONS_BASIC_USER']
            ],
            [
                'name' =>  \arter\amos\invitations\widgets\icons\WidgetIconInvitationsAll::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconInvitationsAll',
                'ruleName' => null,
                'parent' => ['INVITATIONS_ADMINISTRATOR']
            ]

        ];
    }
}