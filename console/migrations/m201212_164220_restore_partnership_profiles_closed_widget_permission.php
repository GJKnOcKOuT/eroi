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
use arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesClosed;

/**
 * Class m201212_164220_restore_partnership_profiles_closed_widget_permission
 */
class m201212_164220_restore_partnership_profiles_closed_widget_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => WidgetIconPartnershipProfilesClosed::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['PARTNERSHIP_PROFILES_READER']
                ]
            ]
        ];
    }
}
