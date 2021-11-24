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
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m180828_103450_add_organizzazioni_roles
 */
class m180828_103450_add_organizzazioni_roles extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(),
            $this->setWidgetsPermissions()
        );
    }

    private function setPluginRoles()
    {
        return [
            [
                'name' => 'AMMINISTRATORE_ORGANIZZAZIONI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for the Organizzazioni plugin',
                'parent' => ['ADMIN'],
                'children' => [
                    'PROFILO_CREATE',
                    'PROFILO_READ',
                    'PROFILO_UPDATE',
                    'PROFILO_DELETE'
                ]
            ],
            [
                'name' => 'LETTORE_ORGANIZZAZIONI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'rEADER role for the Organizzazioni plugin',
                'parent' => ['AMMINISTRATORE_ORGANIZZAZIONI', 'BASIC_USER'],
                'children' => [
                    'PROFILO_READ',
                    \arter\amos\organizzazioni\widgets\icons\WidgetIconProfilo::className()
                ]
            ],
        ];
    }

    private function setWidgetsPermissions()
    {
        return [
            [
                'name' => \arter\amos\organizzazioni\widgets\icons\WidgetIconProfilo::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['PROFILO_READ']
                ]
            ]
        ];
    }
}
