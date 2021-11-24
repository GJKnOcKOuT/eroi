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
 * Class m181015_160647_add_manage_organizzazioni_roles_and_areas_permission
 */
class m181015_160647_add_manage_organizzazioni_roles_and_areas_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'MANAGE_ORGANIZZAZIONI_ROLES_AND_AREAS',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di gestione per ruoli e aree per ogni organizzazione associata a un utente',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI']
            ]
        ];
    }
}
