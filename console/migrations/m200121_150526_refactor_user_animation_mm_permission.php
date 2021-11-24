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
use arter\amos\core\migration\libs\common\MigrationCommon;
use interreg\projects\widgets\icons\WidgetIconAssiDashboard;
use interreg\projects\widgets\icons\WidgetIconCapifilaDashboard;
use interreg\projects\widgets\icons\WidgetIconObiettiviDashboard;
use interreg\projects\widgets\icons\WidgetIconProgettiDashboard;
use yii\rbac\Permission;

/**
 * Class m200121_150526_refactor_user_animation_mm_permission
 */
class m200121_150526_refactor_user_animation_mm_permission extends AmosMigrationPermissions {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        parent::safeUp();
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        MigrationCommon::printConsoleMessage('Migration down for m200121_150526_refactor_user_animation_mm_permission is not allowed');
        return false;
    }

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations() {
        return [
            ['name' => 'USERSANIMATIONMM_CREATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'CM_SFIDE', 'PARTNERSHIP_PROFILES_FACILITATOR'
                    ],
                ],
            ],
            [
                'name' => 'USERSANIMATIONMM_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'CM_SFIDE', 'PARTNERSHIP_PROFILES_FACILITATOR'
                    ],
                ],
            ],
            [
                'name' => 'USERSANIMATIONMM_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'CM_SFIDE', 'PARTNERSHIP_PROFILES_FACILITATOR'
                    ],
                ],
            ],
            [
                'name' => 'USERSANIMATIONMM_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'CM_SFIDE', 'PARTNERSHIP_PROFILES_FACILITATOR'
                    ],
                ],
            ],
        ];
    }

}
