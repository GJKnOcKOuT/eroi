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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWorkflow;
use arter\amos\core\migration\libs\common\MigrationCommon;

/**
 * Class m180117_162216_add_expressions_of_interest_workflow_metadata_1
 */
class m180117_162216_add_expressions_of_interest_workflow_metadata_1 extends AmosMigrationWorkflow
{
    const WORKFLOW_NAME = 'ExpressionsOfInterestWorkflow';
    const STATUS_NAME = 'TOVALIDATE';
    const TABLE_NAME = '{{%sw_metadata}}';

    /**
     * Override this to make operations after adding the workflow configurations.
     * @return bool
     */
    protected function afterAddConfs()
    {
        $this->update(self::TABLE_NAME, ['value' => 'Do you want to begin the assessment of this expression of interest?'], [
            'workflow_id' => self::WORKFLOW_NAME,
            'status_id' => self::STATUS_NAME,
            'key' => 'message'
        ]);
        MigrationCommon::printConsoleMessage('Modificato message stato workflow ExpressionsOfInterestWorkflow in valutazione');
        return true;
    }

    /**
     * Override this to make operations after removing the workflow configurations.
     * @return bool
     */
    protected function afterRemoveConfs()
    {
        $this->update(self::TABLE_NAME, ['value' => 'Do you want to set the validation request status?'], [
            'workflow_id' => self::WORKFLOW_NAME,
            'status_id' => self::STATUS_NAME,
            'key' => 'message'
        ]);
        MigrationCommon::printConsoleMessage('Ripristinato message stato workflow ExpressionsOfInterestWorkflow in valutazione');
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return [
            // "Active" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'ACTIVE',
                'key' => 'buttonLabel',
                'value' => "Submit"
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'ACTIVE',
                'key' => 'message',
                'value' => 'Do you want to submit expression of interest?'
            ],

            // "Draft" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'DRAFT',
                'key' => 'buttonLabel',
                'value' => "#update_expression_of_interest"
            ],

            // "To validate" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'TOVALIDATE',
                'key' => 'buttonLabel',
                'value' => "Begin assessment"
            ],

            // "Relevant" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'RELEVANT',
                'key' => 'buttonLabel',
                'value' => 'Accept'
            ],

            // "Rejected" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'REJECTED',
                'key' => 'buttonLabel',
                'value' => 'Reject'
            ],
        ];
    }
}
