<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m170410_091755_add_permission_news_validate extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'NewsValidate',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate a news with cwh query',
                'ruleName' => \arter\amos\core\rules\ValidatorUpdateContentRule::className(),
                'parent' => ['VALIDATORE_NEWS']
            ],
            [
                'name' => 'NEWS_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['NewsValidate'],
                    'removeParents' => ['VALIDATORE_NEWS']
                ]
            ]
        ];
    }
}
