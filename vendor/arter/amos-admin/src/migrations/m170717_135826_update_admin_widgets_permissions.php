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

use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m170717_135826_update_admin_widgets_permissions
 */
class m170717_135826_update_admin_widgets_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\admin\widgets\graphics\WidgetGraphicMyProfile::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['ADMIN']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconMyProfile::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['ADMIN']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconUserProfile::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['ADMIN']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconValidatedUserProfiles::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['ADMIN']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconFacilitatorUserProfiles::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['ADMIN']
                ]
            ],
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconCommunityManagerUserProfiles::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['ADMIN']
                ]
            ]
        ];
    }
}
