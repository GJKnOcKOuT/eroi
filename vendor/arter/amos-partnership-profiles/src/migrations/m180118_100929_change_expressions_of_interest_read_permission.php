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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\partnershipprofiles\rules\ReadOwnExprOfIntRule;
use yii\rbac\Permission;

/**
 * Class m180118_100929_change_expressions_of_interest_read_permission
 */
class m180118_100929_change_expressions_of_interest_read_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => ReadOwnExprOfIntRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to draft a partnership profile',
                'ruleName' => ReadOwnExprOfIntRule::className(),
                'parent' => ['EXPRESSIONS_OF_INTEREST_CREATOR', 'EXPRESSIONS_OF_INTEREST_READER'],
                'children' => ['EXPRESSIONSOFINTEREST_READ']
            ],
            [
                'name' => 'EXPRESSIONSOFINTEREST_READ',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['EXPRESSIONS_OF_INTEREST_CREATOR', 'EXPRESSIONS_OF_INTEREST_READER']
                ]
            ]
        ];
    }
}
