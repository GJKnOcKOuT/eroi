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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;
use arter\amos\community\models\Community;

/**
 * Class m170301_160956_add_community_validate_and_workflow_permission
 */
class m170301_160956_add_community_validate_and_workflow_permission extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => 'COMMUNITY_VALIDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate a community with no specific domain',
                'ruleName' => null,     // This is a string
                'parent' => ['AMMINISTRATORE_COMMUNITY']
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_DRAFT,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession workflow community staus draft',
                'ruleName' => null,
                'parent' => ['COMMUNITY_CREATE', 'COMMUNITY_UPDATE', 'COMMUNITY_VALIDATE', 'AMMINISTRATORE_COMMUNITY']
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_TO_VALIDATE,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession workflow community staus to validate',
                'ruleName' => null,
                'parent' => ['COMMUNITY_CREATE', 'COMMUNITY_UPDATE', 'COMMUNITY_VALIDATE', 'AMMINISTRATORE_COMMUNITY']
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_VALIDATED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession workflow community staus validated',
                'ruleName' => null,
                'parent' => ['COMMUNITY_VALIDATE', 'AMMINISTRATORE_COMMUNITY']
            ],
            [
                'name' => Community::COMMUNITY_WORKFLOW_STATUS_NOT_VALIDATED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permession workflow community staus not validated',
                'ruleName' => null,
                'parent' => ['COMMUNITY_VALIDATE', 'AMMINISTRATORE_COMMUNITY']
            ]
        ];
    }

}
