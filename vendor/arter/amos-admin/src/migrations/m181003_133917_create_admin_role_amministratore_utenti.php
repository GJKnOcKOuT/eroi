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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\models\UserProfile;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m181003_133917_create_admin_role_amministratore_utenti
 */
class m181003_133917_create_admin_role_amministratore_utenti extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'AMMINISTRATORE_UTENTI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for users',
                'parent' => ['ADMIN'],
                'children' => [
                    'GESTIONE_UTENTI',
                    'CHANGE_USERPROFILE_WORKFLOW_STATUS',
                    'DeactivateAccount',
                    'USERPROFILE_CREATE',
                    'USERPROFILE_READ',
                    'USERPROFILE_UPDATE',
                    'USERPROFILE_DELETE',
                    UserProfile::USERPROFILE_WORKFLOW_STATUS_DRAFT,
                    UserProfile::USERPROFILE_WORKFLOW_STATUS_TOVALIDATE,
                    UserProfile::USERPROFILE_WORKFLOW_STATUS_VALIDATED,
                    UserProfile::USERPROFILE_WORKFLOW_STATUS_NOTVALIDATED,
                    \arter\amos\admin\widgets\graphics\WidgetGraphicMyProfile::className(),
                    \arter\amos\admin\widgets\icons\WidgetIconMyProfile::className(),
                    \arter\amos\admin\widgets\icons\WidgetIconAdmin::className(),
                    \arter\amos\admin\widgets\icons\WidgetIconUserProfile::className(),
                    \arter\amos\admin\widgets\icons\WidgetIconValidatedUserProfiles::className(),
                    \arter\amos\admin\widgets\icons\WidgetIconFacilitatorUserProfiles::className(),
                    \arter\amos\admin\widgets\icons\WidgetIconCommunityManagerUserProfiles::className(),
                    \arter\amos\admin\widgets\icons\WidgetIconInactiveUserProfiles::className()
                ]
            ]
        ];
    }
}
