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

use arter\amos\core\migration\AmosMigrationWorkflow;

/**
 * Class m180612_102838_user_profile_workflow_refactor_metadata
 */
class m180612_102838_user_profile_workflow_refactor_metadata extends AmosMigrationWorkflow
{

    // PER OGNI WORKFLOW ID CONST
    const WORKFLOW_NAME = 'UserProfileWorkflow';
    const WORKFLOW_DRAFT = 'DRAFT';
    const WORKFLOW_TOVALIDATE = 'TOVALIDATE';
    const WORKFLOW_VALIDATED = 'VALIDATED';
    const WORKFLOW_NOTVALIDATED = 'NOTVALIDATED';

    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {

        return [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_TOVALIDATE,
                'key' => 'message',
                'value' => '#' . self::WORKFLOW_TOVALIDATE . '_message'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_VALIDATED,
                'key' => 'message',
                'value' => '#' . self::WORKFLOW_VALIDATED . '_message'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_TOVALIDATE,
                'key' => self::WORKFLOW_VALIDATED.'_description',
                'value' => '#' . self::WORKFLOW_TOVALIDATE . '_' . self::WORKFLOW_VALIDATED . '_description'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_NOTVALIDATED,
                'key' => self::WORKFLOW_VALIDATED.'_buttonLabel',
                'value' => '#' . self::WORKFLOW_NOTVALIDATED . '_' . self::WORKFLOW_VALIDATED . '_buttonLabel'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_NOTVALIDATED,
                'key' => self::WORKFLOW_VALIDATED.'_description',
                'value' => '#' . self::WORKFLOW_NOTVALIDATED . '_' . self::WORKFLOW_VALIDATED . '_description'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_NOTVALIDATED,
                'key' => 'message',
                'value' => '#' . self::WORKFLOW_NOTVALIDATED . '_message'
            ],
        ];
    }
}
