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
 * @package    arter\amos\core\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m171218_115415_permission_content_creator_validator
 */
class m171218_115415_permission_content_creator_validator extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'ContentCreatorOnDomain',
                'type' => Permission::TYPE_PERMISSION,
                'ruleName' => \arter\amos\core\rules\UserCreatorContentOnDomain::className(),
                'description' => 'Permission to create contents on a specific domain',
            ],
            [
                'name' => 'ContentValidatorOnDomain',
                'type' => Permission::TYPE_PERMISSION,
                'ruleName' => \arter\amos\core\rules\UserValidatorContentRule::className(),
                'description' => 'Permission to update contents on a specific domain',
            ]
        ];
    }

}
