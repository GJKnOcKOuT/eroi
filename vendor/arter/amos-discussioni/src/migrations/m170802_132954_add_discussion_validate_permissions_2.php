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
 * @package    arter\amos\discussioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\discussioni\models\DiscussioniTopic;
use yii\rbac\Permission;

/**
 * Class m170802_132954_add_discussion_validate_permissions_2
 */
class m170802_132954_add_discussion_validate_permissions_2 extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'DiscussionValidateOnDomain',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate at least one discussion in a domain with cwh permission',
                'ruleName' => \arter\amos\core\rules\UserValidatorContentRule::className(),
                'parent' => ['VALIDATORE_DISCUSSIONI', 'VALIDATED_BASIC_USER']
            ],
            [
                'name' => 'DiscussionValidate',
                'update' => true,
                'newValues' => [
                    'addParents' => ['VALIDATED_BASIC_USER']
                ]
            ],
            [
                'name' => arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicDaValidare::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['DiscussionValidateOnDomain']
                ]
            ],
            [
                'name' => DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_BOZZA,
                'update' => true,
                'newValues' => [
                    'addParents' => ['DiscussionValidate']
                ]
            ],
            [
                'name' => DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_DAVALIDARE,
                'update' => true,
                'newValues' => [
                    'addParents' => ['DiscussionValidate']
                ]
            ],
            [
                'name' => DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_ATTIVA,
                'update' => true,
                'newValues' => [
                    'addParents' => ['DiscussionValidate']
                ]
            ]
        ];
    }
}
