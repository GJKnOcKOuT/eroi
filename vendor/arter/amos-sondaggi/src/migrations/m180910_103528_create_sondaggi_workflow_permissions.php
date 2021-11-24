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
 * @package    arter\amos\sondaggi\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\sondaggi\models\Sondaggi;
use yii\rbac\Permission;

/**
 * Class m180910_103528_create_sondaggi_workflow_permissions
 */
class m180910_103528_create_sondaggi_workflow_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => Sondaggi::WORKFLOW_STATUS_BOZZA,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow Sondaggi: Bozza',
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
            [
                'name' => Sondaggi::WORKFLOW_STATUS_DAVALIDARE,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow Sondaggi: Da validare',
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
            [
                'name' => Sondaggi::WORKFLOW_STATUS_VALIDATO,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso stato workflow Sondaggi: Validato',
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ]
        ];
    }
}
