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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;
use arter\amos\events\models\Event;

/**
 * Class m170803_074914_add_events_validate_permissions_2
 */
class m170803_074914_add_events_validate_permissions_2 extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'EventValidateOnDomain',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate at least one event in a domain with cwh permission',
                'ruleName' => \arter\amos\core\rules\UserValidatorContentRule::className(),
                'parent' => ['PLATFORM_EVENTS_VALIDATOR', 'EVENTS_VALIDATOR', 'VALIDATED_BASIC_USER']
            ],
            [
                'name' => 'EventValidate',
                'update' => true,
                'newValues' => [
                    'addParents' => ['VALIDATED_BASIC_USER']
                ]
            ],
            [
                'name' => arter\amos\events\widgets\icons\WidgetIconEventsToPublish::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['EventValidateOnDomain']
                ]
            ],
            [
                'name' => Event::EVENTS_WORKFLOW_STATUS_DRAFT,
                'update' => true,
                'newValues' => [
                    'addParents' => ['EventValidate']
                ]
            ],
            [
                'name' => Event::EVENTS_WORKFLOW_STATUS_PUBLISHREQUEST,
                'update' => true,
                'newValues' => [
                    'addParents' => ['EventValidate']
                ]
            ],
            [
                'name' => Event::EVENTS_WORKFLOW_STATUS_PUBLISHED,
                'update' => true,
                'newValues' => [
                    'addParents' => ['EventValidate']
                ]
            ]
        ];
    }
}

?>
