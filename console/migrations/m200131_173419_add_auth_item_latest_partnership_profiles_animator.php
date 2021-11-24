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
 * Class m200131_173419_add_auth_item_latest_partnership_profiles_animator */
class m200131_173419_add_auth_item_latest_partnership_profiles_animator extends AmosMigrationPermissions {

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations() {
        $prefixStr = 'Permissions for the dashboard for the widget ';

        return [
            [
                'name' => \backend\modules\aster_partnership_profiles\widget\graphics\WidgetGraphicsLatestPartnershipProfilesAnimator::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'WidgetGraphicsLatestPartnershipProfilesAnimator',
                'ruleName' => null,
                'parent' => ['CM_SFIDE', 'PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR']
            ]
        ];
    }

}
