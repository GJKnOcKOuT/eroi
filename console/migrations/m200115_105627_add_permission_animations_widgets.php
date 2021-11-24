<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class m180327_162827_add_auth_item_een_archived*/
class m200115_105627_add_permission_animations_widgets extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for Animations';

        return [
            [
                'name' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideWidgetIcon::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso animazione sfide Widget',
                'parent' => ['CM_SFIDE','PARTNERSHIP_PROFILES_FACILITATOR'],
            ],
            [
                'name' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideToValidateWidgetIcon::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso animazione sfide Widget',
                'parent' => ['CM_SFIDE','PARTNERSHIP_PROFILES_FACILITATOR'],
            ],
            [
                'name' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfidePublishedWidgetIcon::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso animazione sfide Widget',
                'parent' => ['CM_SFIDE','PARTNERSHIP_PROFILES_FACILITATOR'],
            ],
            [
                'name' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideToAssignWidgetIcon::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso animazione sfide Widget',
                'parent' => ['CM_SFIDE'],
            ],
            [
                'name' =>  \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideAssignedWidgetIcon::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso animazione sfide Widget',
                'parent' => ['CM_SFIDE'],
            ],
        ];
    }
}
