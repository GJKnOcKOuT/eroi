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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m170529_104009_add_basic_user_perms
 */
class m170529_104009_add_basic_user_perms extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'LETTORE_DOCUMENTI',
                'update' => true,
                'newValues' => [
                    'addParents' => ['BASIC_USER']
                ]
            ],
            [
                'name' => 'CREATORE_DOCUMENTI',
                'update' => true,
                'newValues' => [
                    'addParents' => ['VALIDATED_BASIC_USER']
                ]
            ]
        ];
    }
}
