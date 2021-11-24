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

use arter\amos\core\migration\libs\common\MigrationCommon;
use yii\db\Migration;

/**
 * Class m171221_160155_modify_expressions_of_interest_workflow_1
 */
class m171221_160155_modify_expressions_of_interest_workflow_1 extends Migration
{
    const WORKFLOW_NAME = 'ExpressionsOfInterestWorkflow';
    const STATUS_NAME = 'TOVALIDATE';
    const TABLE_NAME = '{{%sw_metadata}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update(self::TABLE_NAME, ['value' => 'In evaluation'], [
            'workflow_id' => self::WORKFLOW_NAME,
            'status_id' => self::STATUS_NAME,
            'key' => 'label'
        ]);
        MigrationCommon::printConsoleMessage('Modificata label stato workflow in valutazione');
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update(self::TABLE_NAME, ['value' => 'Validation request'], [
            'workflow_id' => self::WORKFLOW_NAME,
            'status_id' => self::STATUS_NAME,
            'key' => 'label'
        ]);
        MigrationCommon::printConsoleMessage('Ripristinata label stato workflow in valutazione');
        return true;
    }
}
