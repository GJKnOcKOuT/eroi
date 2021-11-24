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
 * Class m171220_153854_add_create_subcommunities_permission
 */
class m171220_153854_add_create_subcommunities_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'CreateSubcommunities',
                'type' => Permission::TYPE_PERMISSION,
                'ruleName' => \arter\amos\community\rules\CreateSubcommunitiesRule::className(),
                'description' => 'Permission to create subcommunities under a specific community parent',
            ],
        ];
    }
}
