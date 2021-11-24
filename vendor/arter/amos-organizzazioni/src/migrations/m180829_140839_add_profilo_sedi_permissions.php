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
 * Class m180829_140839_add_profilo_sedi_permissions
 */
class m180829_140839_add_profilo_sedi_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'PROFILOSEDI_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model ProfiloSedi',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI']
            ],
            [
                'name' => 'PROFILOSEDI_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model ProfiloSedi',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI']
            ],
            [
                'name' => 'PROFILOSEDI_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model ProfiloSedi',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI']
            ],
            [
                'name' => 'PROFILOSEDI_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model ProfiloSedi',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI']
            ],
        ];
    }
}
