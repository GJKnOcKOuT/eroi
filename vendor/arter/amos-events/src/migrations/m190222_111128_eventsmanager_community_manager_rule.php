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
 * @package    arter\amos\news\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m190222_111128_eventsmanager_community_manager_rule
 */
class m190222_111128_eventsmanager_community_manager_rule extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\core\rules\BasicCommunityManagerRoleRule::className(),
                'type' => \yii\rbac\Permission::TYPE_PERMISSION,
                'description' => 'Regola per gestire eventi se sei CM',
                'ruleName' => \arter\amos\core\rules\BasicCommunityManagerRoleRule::className(),
                'parent' => ['VALIDATED_BASIC_USER'],
                'children' => ['EVENT_MANAGER']
            ]
        ];
    }
}
