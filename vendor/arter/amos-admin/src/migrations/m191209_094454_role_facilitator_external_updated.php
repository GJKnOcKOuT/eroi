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
use yii\rbac\Permission;

/**
 * Class m181018_134854_add_admin_tag_tabs_permission
 */
class m191209_094454_role_facilitator_external_updated extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [

            [
                'name' => 'VALIDATOR',
                'type' => Permission::TYPE_ROLE,
                'update' => true,
                'newValues' => [
                    'removeParents' => ['FACILITATOR_EXTERNAL']
                ]
            ],
//            [
//                'name' => 'FACILITATORE_NEWS',
//                'type' => Permission::TYPE_ROLE,
//                'update' => true,
//                'newValues' => [
//                    'addParents' => ['FACILITATOR_EXTERNAL']
//                ]
//            ],
//            [
//                'name' => 'FACILITATORE_DISCUSSIONI',
//                'type' => Permission::TYPE_ROLE,
//                'update' => true,
//                'newValues' => [
//                    'addParents' => ['FACILITATOR_EXTERNAL']
//                ]
//            ],
//            [
//                'name' => 'FACILITATORE_DOCUMENTI',
//                'type' => Permission::TYPE_ROLE,
//                'update' => true,
//                'newValues' => [
//                    'addParents' => ['FACILITATOR_EXTERNAL']
//                ]
//            ],
//            [
//                'name' => 'SHOWCASEPROJECT_FACILITATOR',
//                'type' => Permission::TYPE_ROLE,
//                'update' => true,
//                'newValues' => [
//                    'addParents' => ['FACILITATOR_EXTERNAL']
//                ]
//            ],
        ];
    }
}
