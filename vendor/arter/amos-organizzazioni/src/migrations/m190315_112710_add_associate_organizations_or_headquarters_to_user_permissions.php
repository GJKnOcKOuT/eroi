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
 * @package    arter\amos\organizzazioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m190315_112710_add_associate_organizations_or_headquarters_to_user_permissions
 */
class m190315_112710_add_associate_organizations_or_headquarters_to_user_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'ASSOCIATE_PROFILO_TO_USER_PERMISSION',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per poter associarsi a una organizzazione nel profilo utente',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI', 'LETTORE_ORGANIZZAZIONI']
            ],
            [
                'name' => 'ASSOCIATE_PROFILO_SEDI_TO_USER_PERMISSION',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per poter associarsi a una sede di una organizzazione nel profilo utente',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI', 'LETTORE_ORGANIZZAZIONI']
            ]
        ];
    }
}
