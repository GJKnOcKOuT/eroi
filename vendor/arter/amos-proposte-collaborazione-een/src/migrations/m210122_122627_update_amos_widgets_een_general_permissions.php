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


/**
 * Class m210122_122627_update_amos_widgets_een_general_permissions*/
class m210122_122627_update_amos_widgets_een_general_permissions extends AmosMigrationPermissions
{

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {

        return [
            [
                'name' =>  \arter\amos\een\widgets\icons\WidgetIconEenDashboardGeneral::className(),
                'update' =>true,
                'newValues' => [
                    'removeParents' => ['EEN_READER']
                ]
            ]
        ];
    }
}
