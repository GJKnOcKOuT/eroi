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
 * @package    arter\amos\projectmanagement\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWorkflow;

/**
 * Class m190522_155100_expressionofinterest_workflow_refactor_metadata
 */
class m190522_155100_expressionofinterest_workflow_refactor_metadata extends AmosMigrationWorkflow
{
    const WORKFLOW_NAME = 'ExpressionsOfInterestWorkflow';

    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'remove' => true,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'ACTIVE',
                'key' => 'label',
                'value' => 'Active'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'ACTIVE',
                'key' => 'label',
                'value' => '#'.self::WORKFLOW_NAME.'_ACTIVE_label'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'remove' => true,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'DRAFT',
                'key' => 'label',
                'value' => 'Draft'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'DRAFT',
                'key' => 'label',
                'value' => '#'.self::WORKFLOW_NAME.'_DRAFT_label'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'remove' => true,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'REJECTED',
                'key' => 'label',
                'value' => 'Rejected'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'REJECTED',
                'key' => 'label',
                'value' => '#'.self::WORKFLOW_NAME.'_REJECTED_label'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'remove' => true,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'RELEVANT',
                'key' => 'label',
                'value' => 'Relevant'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'RELEVANT',
                'key' => 'label',
                'value' => '#'.self::WORKFLOW_NAME.'_RELEVANT_label'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'remove' => true,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'TOVALIDATE',
                'key' => 'label',
                'value' => 'In evaluation'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'TOVALIDATE',
                'key' => 'label',
                'value' => '#'.self::WORKFLOW_NAME.'_TOVALIDATE_label'
            ],
        ];
    }
}