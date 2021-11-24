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

use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesArchived;
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesClosed;
use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m190423_165427_refactor_aster_widget_partnership_profiles_roles
 */
class m190423_165427_refactor_aster_widget_partnership_profiles_roles extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => WidgetIconPartnershipProfilesArchived::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['PARTNERSHIP_PROFILES_READER']
                ]
            ],
            [
                'name' => WidgetIconPartnershipProfilesClosed::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['PARTNERSHIP_PROFILES_READER']
                ]
            ],
        ];
    }
}
