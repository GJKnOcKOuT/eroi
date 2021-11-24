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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170719_122922_permissions_community
 */
class m180207_171122_permissions_sondaggi extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'COMPILATORE_SONDAGGI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo compilatore sondaggi',
                'ruleName' => null,
                'parent' => ['BASIC_USER']
            ],
            [
                'name' => arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['COMPILATORE_SONDAGGI']
                ]
            ],
            [
                'name' => 'SONDAGGI_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => ['COMPILATORE_SONDAGGI']
                ]
            ],
        ];
    }
}
