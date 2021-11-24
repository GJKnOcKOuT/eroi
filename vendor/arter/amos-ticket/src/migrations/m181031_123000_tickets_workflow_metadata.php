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
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWorkflow;

/**
 * Class m181031_123000_tickets_workflow_metadata
 */
class m181031_123000_tickets_workflow_metadata extends AmosMigrationWorkflow
{
    // PER OGNI WORKFLOW ID CONST
    const WORKFLOW_NAME = 'TicketWorkflow';
    const WORKFLOW_WAITING = 'WAITING';
    const WORKFLOW_PROCESSING = 'PROCESSING';
    const WORKFLOW_CLOSED = 'CLOSED';

    /**
     * @inheritdoc
     */
    protected function beforeAddConfs()
    {
        $this->delete('sw_metadata', 'workflow_id = "' . self::WORKFLOW_NAME . '"');
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return [
            // "DRAFT" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_WAITING,
                'key' => 'buttonLabel',
                'value' => '#' . self::WORKFLOW_WAITING . '_buttonLabel'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_WAITING,
                'key' => 'description',
                'value' => '#' . self::WORKFLOW_WAITING . '_description'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_WAITING,
                'key' => 'label',
                'value' => '#' . self::WORKFLOW_WAITING . '_label'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_WAITING,
                'key' => self::WORKFLOW_PROCESSING . '_buttonLabel',
                'value' => '#' . self::WORKFLOW_WAITING . '_' . self::WORKFLOW_PROCESSING . '_buttonLabel'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_WAITING,
                'key' => self::WORKFLOW_PROCESSING . '_description',
                'value' => '#' . self::WORKFLOW_WAITING . '_' . self::WORKFLOW_PROCESSING . '_description'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_WAITING,
                'key' => self::WORKFLOW_CLOSED . '_buttonLabel',
                'value' => '#' . self::WORKFLOW_WAITING . '_' . self::WORKFLOW_CLOSED . '_buttonLabel'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_WAITING,
                'key' => self::WORKFLOW_CLOSED . '_description',
                'value' => '#' . self::WORKFLOW_WAITING . '_' . self::WORKFLOW_CLOSED . '_description'
            ],
            // TOVALIDATE
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_PROCESSING,
                'key' => 'buttonLabel',
                'value' => '#' . self::WORKFLOW_PROCESSING . '_buttonLabel'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_PROCESSING,
                'key' => 'description',
                'value' => '#' . self::WORKFLOW_PROCESSING . '_description'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_PROCESSING,
                'key' => 'label',
                'value' => '#' . self::WORKFLOW_PROCESSING . '_label'
            ],
            // VALIDATED
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'buttonLabel',
                'value' => '#' . self::WORKFLOW_CLOSED . '_buttonLabel'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'description',
                'value' => '#' . self::WORKFLOW_CLOSED . '_description'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_CLOSED,
                'key' => 'label',
                'value' => '#' . self::WORKFLOW_CLOSED . '_label'
            ],
            // -----------------------------------------------------------
        ];
    }
}
