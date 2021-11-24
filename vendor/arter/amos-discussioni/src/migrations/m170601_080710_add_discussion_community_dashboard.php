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
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

class m170601_080710_add_discussion_community_dashboard extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => WidgetIconDiscussioniDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to discussion dashboard',
                'parent' => ['BASIC_USER']
            ],
        ];
    }
}
