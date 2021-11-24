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
 * Class m200207_171354_fix_validator_permissions
 */
class m200207_171354_fix_validator_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'VALIDATORE_NEWS',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['AMMINISTRATORE_NEWS']
                ]
            ],
            [
                'name' => 'VALIDATORE_DOCUMENTI',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['AMMINISTRATORE_DOCUMENTI']
                ]
            ],
            [
                'name' => 'VALIDATORE_DISCUSSIONI',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['AMMINISTRATORE_DISCUSSIONI']
                ]
            ],
            [
                'name' => 'PLATFORM_EVENTS_VALIDATOR',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['EVENTS_ADMINISTRATOR']
                ]
            ],
            [
                'name' => 'EVENTS_VALIDATOR',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['EVENTS_ADMINISTRATOR']
                ]
            ]
        ];
    }
}
