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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWorkflow;

/**
 * Class m180601_153734_add_documenti_workflow_metadata_for_folder
 */
class m180601_153734_add_documenti_workflow_metadata_for_folder extends AmosMigrationWorkflow
{
    const WORKFLOW_NAME = 'DocumentiWorkflow';
    const WORKFLOW_DRAFT = 'BOZZA';
    const WORKFLOW_TOVALIDATE = 'DAVALIDARE';
    const WORKFLOW_VALIDATED = 'VALIDATO';

    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return [
            // DOCUMENTI WORKFLOW
            // "DRAFT" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_DRAFT,
                'key' => 'labelFolder',
                'value' => '#' . self::WORKFLOW_DRAFT . '_labelFolder'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_DRAFT,
                'key' => self::WORKFLOW_VALIDATED . '_descriptionFolder',
                'value' => '#' . self::WORKFLOW_DRAFT . '_' . self::WORKFLOW_VALIDATED . '_descriptionFolder'
            ],
            // TOVALIDATE
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_TOVALIDATE,
                'key' => 'labelFolder',
                'value' => '#' . self::WORKFLOW_TOVALIDATE . '_labelFolder'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_TOVALIDATE,
                'key' => 'descriptionFolder',
                'value' => '#' . self::WORKFLOW_TOVALIDATE . '_descriptionFolder'
            ],
            // VALIDATED
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_VALIDATED,
                'key' => 'labelFolder',
                'value' => '#' . self::WORKFLOW_VALIDATED . '_labelFolder'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => self::WORKFLOW_VALIDATED,
                'key' => 'descriptionFolder',
                'value' => '#' . self::WORKFLOW_VALIDATED . '_descriptionFolder'
            ],
            // -----------------------------------------------------------
        ];
    }
}
