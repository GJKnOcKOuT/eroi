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
 * @package    arter\amos\bestpractice
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\best\practice\models\BestPractice;
use arter\amos\core\migration\AmosMigrationWorkflow;

/**
 * Class m190530_105808_add_transition_best_practice_workflow
 */
class m190530_105808_add_transition_best_practice_workflow extends AmosMigrationWorkflow
{
    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_TRANSITION,
                'workflow_id' => BestPractice::BESTPRACTICE_WORKFLOW,
                'start_status_id' => 'DRAFT',
                'end_status_id' => 'VALIDATED'
            ]
        ];
    }
}
