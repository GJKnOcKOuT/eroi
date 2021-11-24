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
 * Class m190430_124200_partnershipprofiles_workflow_refactor_metadata
 */
class m190430_124200_partnershipprofiles_workflow_refactor_metadata extends AmosMigrationWorkflow
{
    const WORKFLOW_NAME = 'PartnershipProfilesWorkflow';
    const WORKFLOW_CLOSED = 'CLOSED';

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
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'label',
                'value' => 'Close'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'remove' => true,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'description',
                'value' => 'The partnership profile will be closed'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'label',
                'value' => '#'.self::WORKFLOW_NAME.'_'.self::WORKFLOW_CLOSED.'_label'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'description',
                'value' => '#'.self::WORKFLOW_NAME.'_'.self::WORKFLOW_CLOSED.'_description'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'buttonLabel',
                'value' => '#'.self::WORKFLOW_NAME.'_'.self::WORKFLOW_CLOSED.'_buttonLabel'
            ],
        ];
    }
}

