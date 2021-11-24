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
 * Class m200131_152725_refactore_facilitator_role */
class m200131_152725_refactore_facilitator_role extends AmosMigrationPermissions {

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations() {
        $prefixStr = '';

        return [
            [
                'name' => 'PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR',
                'update' => true,
                'newValues' => [
                    'removeParents' => ['FACILITATOR'],
                ]
            ],
        ];
    }

}
