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
 * @package    arter\amos\report\migrations
 * @category   Migration
 * @author     Elite Division S.r.l.
 */

use arter\amos\report\models\Report;
use yii\db\Migration;

/**
 * Class m170720_124351_alter_table_report_add_validator_id
 */
class m170720_124351_alter_table_report_add_validator_id extends Migration
{
    public function safeUp()
    {
        $this->addColumn(Report::tableName(), 'validator_id', $this->integer()->null()->defaultValue(null)->after('creator_id'));

        $reports = Report::find()->all();
        foreach ($reports as $report){
            $className = $report->classname;
            $contentModel = $className::findOne($report->context_id);
            if(!empty($contentModel)) {
                $report->creator_id = $contentModel->created_by;
                if (!is_null($contentModel->getBehavior('workflowLog')) && $contentModel->hasMethod('getValidatedStatus')) {
                    $validatorId = $contentModel->getStatusLastUpdateUser($contentModel->getValidatedStatus());
                    $report->validator_id = $validatorId;
                }
                $report->save();
            }
        }
        return true;

    }

    public function safeDown()
    {

        $reports = Report::find()->all();
        foreach ($reports as $report){
            $report->creator_id = $report->created_by;
            $report->save();
        }
        $this->dropColumn(Report::tableName(), 'validator_id');

        return true;
    }

}
