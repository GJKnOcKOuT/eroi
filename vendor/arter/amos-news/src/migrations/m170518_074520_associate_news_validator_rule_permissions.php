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
use arter\amos\news\models\News;
use yii\rbac\Permission;

/**
 * Class m170518_074520_associate_news_validator_rule_permissions
 */
class m170518_074520_associate_news_validator_rule_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'NewsValidateOnDomain',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate at least one news in a domain with cwh permission',
                'ruleName' => \arter\amos\core\rules\UserValidatorContentRule::className(),
                'parent' => ['VALIDATORE_NEWS']
            ],
            [
                'name' => 'NEWS_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['NewsValidateOnDomain'],
                    'removeParents' => ['VALIDATORE_NEWS']
                ]
            ],
            [
                'name' => News::NEWS_WORKFLOW_STATUS_BOZZA,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso workflow news stato bozza',
                'ruleName' => null,
                'parent' => ['NewsValidateOnDomain'],
                'dontRemove' => true
            ],
            [
                'name' => News::NEWS_WORKFLOW_STATUS_DAVALIDARE,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso workflow news stato da validare',
                'ruleName' => null,
                'parent' => ['NewsValidateOnDomain'],
                'dontRemove' => true
            ],
            [
                'name' => News::NEWS_WORKFLOW_STATUS_VALIDATO,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso workflow news stato validato',
                'ruleName' => null,
                'parent' => ['NewsValidateOnDomain'],
                'dontRemove' => true
            ],
            [
                'name' => arter\amos\news\widgets\icons\WidgetIconNewsDaValidare::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconNewsDaValidare',
                'ruleName' => null,
                'parent' => ['NewsValidateOnDomain'],
                'dontRemove' => true
            ]
        ];
    }
}
