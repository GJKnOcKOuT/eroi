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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170411_125209_add_admin_cwh_role_to_admin
 */
class m170411_125209_add_admin_cwh_role_to_admin extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => 'AMMINISTRATORE_CWH',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo per amministrare CWH',
                'ruleName' => null,
                'parent' => ['ADMIN'],
                'dontRemove' => true
            ]
        ];

    }
}
