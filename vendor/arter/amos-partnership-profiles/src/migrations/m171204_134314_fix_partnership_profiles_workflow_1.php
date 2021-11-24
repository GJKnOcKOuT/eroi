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

/**
 * Class m171204_134314_fix_partnership_profiles_workflow_1
 */
class m171204_134314_fix_partnership_profiles_workflow_1 extends AmosMigrationWorkflow
{
    const WORKFLOW_NAME = 'PartnershipProfilesWorkflow';

    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'FEEDBACKRECEIVED',
                'key' => 'hidden',
                'value' => 'true'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::WORKFLOW_NAME,
                'status_id' => 'ARCHIVED',
                'key' => 'hidden',
                'value' => 'true'
            ]
        ];
    }
}
