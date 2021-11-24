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
class m180118_114222_permissions_community_read_rule extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\community\rules\ReadCommunityRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di aggiornare il proprio profilo della community',
                'ruleName' => \arter\amos\community\rules\ReadCommunityRule::className(),
                'parent' => ['COMMUNITY_READER','COMMUNITY_MEMBER','COMMUNITY_CREATOR']
            ],
            [
                'name' => 'COMMUNITY_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => [\arter\amos\community\rules\ReadCommunityRule::className()],
                    'removeParents' => ['COMMUNITY_READER', 'COMMUNITY_MEMBER','COMMUNITY_CREATOR']
                ]
            ]
        ];
    }
}
