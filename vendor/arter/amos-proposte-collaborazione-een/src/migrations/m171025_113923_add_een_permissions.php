<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


class m171025_113923_add_een_permissions extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = array_merge(
            $this->setRolesRoles(),
            $this->setModelPermissions(),
            $this->setWidgetsPermissions()
        );
    }

    private function setRolesRoles()
    {
        return [
            [
                'name' => 'EEN_READER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Lettore di proposte di collaborazione EEN',
                'ruleName' => null,
                'parent' => ['ADMIN', 'BASIC_USER']
            ],
            [
                'name' => 'EEN_VALIDATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Lettore di proposte di collaborazione EEN',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
        ];
    }

    private function setModelPermissions()
    {
        return [

            [
                'name' => 'EENPARTNERSHIPPROPOSAL_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di lettura per il model EenPartnershipProposal',
                'ruleName' => null,
                'parent' => ['EEN_READER']
            ],

        ];
    }

    private function setWidgetsPermissions()
    {
        $prefixStr = 'Permesso per la dashboard per il widget ';
        return [
            [
                'name' => \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconEenDashboard',
                'ruleName' => null,
                'parent' => ['EEN_READER']
            ],
            [
                'name' => \arter\amos\een\widgets\icons\WidgetIconEenAll::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconEen',
                'ruleName' => null,
                'parent' => ['EEN_READER']
            ],
            [
                'name' => \arter\amos\een\widgets\icons\WidgetIconEen::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconEen',
                'ruleName' => null,
                'parent' => ['EEN_READER']
            ],

        ];
    }
}
