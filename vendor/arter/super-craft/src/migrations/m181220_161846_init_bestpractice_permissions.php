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
 * @package    arter\amos\best\practice\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;


/**
 * Class m181220_161846_init_bestpractice_permissions
 */
class m181220_161846_init_bestpractice_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setPluginRoles(),
            $this->setModelPermissions(),
            $this->setWidgetsPermissions()
        );
    }

    private function setPluginRoles()
    {
        return [
            [
                'name' => 'BESTPRACTICE_ADMINISTRATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator role for the best practice plugin',
                'parent' => ['ADMIN'],
            ],
            [
                'name' => 'BESTPRACTICE_CREATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Creator of best practice ',
                'parent' => ['BASIC_USER'],
            ],
            [
                'name' => 'BESTPRACTICE_VALIDATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'validator of best practice ',
                'parent' => ['ADMIN'],
            ],
            [
                'name' => 'BESTPRACTICE_READER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Reader of best practice',
                'parent' => ['BASIC_USER'],
            ],
        ];
    }

    private function setModelPermissions()
    {
        return [

            // Permissions for model BestPractice
            [
                'name' => 'BESTPRACTICE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Create permission for model Best Practice',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR']
            ],
            [
                'name' => 'BESTPRACTICE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Read permission for model Best Practice',
                'parent' => ['BestPracticeRead']
            ],
            [
                'name' => 'BESTPRACTICE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Update permission for model Best Practice',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR', 'BESTPRACTICE_VALIDATOR']
            ],
            [
                'name' => 'BESTPRACTICE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Delete permission for model Best Practice',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR']
            ],
            [
                'name' => 'BestPracticeRead',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to read a Best Practice ',
                'ruleName' => \arter\amos\core\rules\ReadContentRule::className(),
                'parent' => ['BESTPRACTICE_ADMINISTRATOR', 'BESTPRACTICE_CREATOR', 'BESTPRACTICE_VALIDATOR', 'BESTPRACTICE_READER']
            ],
            [
                'name' => 'BESTPRACTICE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Create permission for model Best Practice',
                'parent' => ['BESTPRACTICE_CREATOR']
            ],
            [
                'name' => \arter\amos\best\practice\rules\UpdateOwnBestPracticeRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permessso di modifica di una propria best practice',
                'ruleName' => \arter\amos\best\practice\rules\UpdateOwnBestPracticeRule::className(),
                'parent' => ['BESTPRACTICE_CREATOR']
            ],
            [
                'name' => \arter\amos\best\practice\rules\DeleteOwnBestPracticeRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permessso di cancellazione di una propria best practice',
                'ruleName' => \arter\amos\best\practice\rules\DeleteOwnBestPracticeRule::className(),
                'parent' => ['BESTPRACTICE_CREATOR']
            ],


        ];
    }

    private function setWidgetsPermissions()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeOwnInterest::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconBestPracticeBusinessModels',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR','BESTPRACTICE_CREATOR', 'BESTPRACTICE_READER']
            ],
            [
                'name' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeAll::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconBestPracticeCategories',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR','BESTPRACTICE_CREATOR', 'BESTPRACTICE_READER']
            ],
            [
                'name' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeCreatedBy::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconBestPracticeCertificates',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR','BESTPRACTICE_CREATOR']
            ],
            [
                'name' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconBestPracticeDashboard',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR','BESTPRACTICE_CREATOR','BESTPRACTICE_VALIDATOR', 'BESTPRACTICE_READER']
            ],
            [
                'name' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeToValidate::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconBestPracticeToValidate',
                'parent' => ['BESTPRACTICE_VALIDATOR']
            ],
            [
                'name' =>arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeAdminAll::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetIconBestPracticeTerritories',
                'parent' => ['BESTPRACTICE_ADMINISTRATOR']
            ],
        ];
    }
}
