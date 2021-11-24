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

use arter\amos\admin\rules\UpdateProfileFacilitatorRule;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170724_074724_associate_default_facilitator_rule_to_facilitator_role
 */
class m170724_074724_associate_default_facilitator_rule_to_facilitator_role extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => UpdateProfileFacilitatorRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission for FACILITATOR role to update the profiles for which it is facilitator',
                'ruleName' => UpdateProfileFacilitatorRule::className(),
                'parent' => ['FACILITATOR']
            ],
            [
                'name' => 'USERPROFILE_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => ['FACILITATOR']
                ]
            ],
            [
                'name' => 'USERPROFILE_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [UpdateProfileFacilitatorRule::className()]
                ]
            ]
        ];
    }
}
