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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m171008_090411_add_documenti_cwh_permission
 */
class m171008_090411_add_documenti_cwh_permission extends AmosMigrationPermissions
{

    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [

            [
                'name' => 'CWH_PERMISSION_CREATE_arter\amos\documenti\models\Documenti',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Creare arter\\amos\\documenti\\models\\Docuemnti',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_CWH']
            ],
            [
                'name' => 'CWH_PERMISSION_VALIDATE_arter\amos\documenti\models\Documenti',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Validare arter\\amos\\documenti\\models\\Documenti',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_CWH']
            ],
        ];
    }
}
