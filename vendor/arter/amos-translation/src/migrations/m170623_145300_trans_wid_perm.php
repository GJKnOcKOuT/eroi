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
 * @package    arter\amos\translation\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m170623_145300_trans_wid_perm
 */
class m170623_145300_trans_wid_perm extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(), $this->setModelPermissions(), $this->setWidgetsPermissions()
        );
    }

    private function setPluginRoles()
    {
        return [
            [
                'name' => 'TRANSLATE_MANAGER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for translation plugin',
                'parent' => ['ADMIN']
            ],
            [
                'name' => 'CONTENT_TRANSLATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Content translator role for Translation plugin',
                'parent' => ['ADMIN']
            ]
        ];
    }

    private function setModelPermissions()
    {
        return [
            [
                'name' => 'TRANSLATOR',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER'],
                'dontRemove' => true,
            ],
            [
                'name' => 'TRANSLATION_ADMINISTRATOR',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to translate',
                'parent' => ['TRANSLATE_MANAGER'],
                'dontRemove' => true,
            ],
        ];
    }

    private function setWidgetsPermissions()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => \arter\amos\translation\widgets\icons\WidgetIconTranslation::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTranslation',
                'parent' => ['TRANSLATE_MANAGER', 'CONTENT_TRANSLATOR']
            ],
            [
                'name' => \arter\amos\translation\widgets\icons\WidgetIconTrContents::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrContents',
                'parent' => ['TRANSLATE_MANAGER', 'CONTENT_TRANSLATOR']
            ],
            [
                'name' => \arter\amos\translation\widgets\icons\WidgetIconTrPlatform::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrPlatform',
                'parent' => ['TRANSLATE_MANAGER', 'CONTENT_TRANSLATOR']
            ],
            [
                'name' => \arter\amos\translation\widgets\icons\WidgetIconTrLanguage::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrLanguage',
                'parent' => ['TRANSLATE_MANAGER']
            ],
            [
                'name' => \arter\amos\translation\widgets\icons\WidgetIconTrOptimize::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrOptimize',
                'parent' => ['TRANSLATE_MANAGER']
            ],
            [
                'name' => \arter\amos\translation\widgets\icons\WidgetIconTrScan::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconTrScan',
                'parent' => ['TRANSLATE_MANAGER']
            ],
        ];
    }
}
