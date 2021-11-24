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

use arter\amos\admin\rules\DeactivateAccountRule;
use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m180521_140827_modify_admin_permission_deactivate_account
 */
class m180521_140827_modify_admin_permission_deactivate_account extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'DeactivateAccount',
                'update' => true,
                'newValues' => [
                    'ruleName' => DeactivateAccountRule::className()
                ],
                'oldValues' => [
                    'ruleName' => null
                ]
            ]
        ];
    }
}
