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

/**
 * Class m200219_181625_refactore_cm_permission_tab_to_validate */
class m200219_181625_refactore_cm_permission_tab_to_validate extends AmosMigrationPermissions {

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations() {
        $prefixStr = '';

        return [
            [
                'name' => \backend\modules\aster_partnership_profiles\widget\icons\AnimazioneSfideToValidateWidgetIcon::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['CM_SFIDE'],
                ]
            ],
        ];
    }

}
