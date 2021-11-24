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
 * @package    arter\amos\sondaggi\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m190205_145830_add_sondaggi_permissions
 */
class m190205_145830_add_sondaggi_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'SONDAGGI_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIDOMANDE_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIDOMANDE_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIDOMANDEPAGINE_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIDOMANDEPAGINE_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIRISPOSTEPREDEFINITE_CREATE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIRISPOSTEPREDEFINITE_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIRISPOSTEPREDEFINITE_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ],
            [
                'name' => 'SONDAGGIRISPOSTEPREDEFINITE_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['SondaggiValidate']
                ]
            ]
        ];
    }
}
