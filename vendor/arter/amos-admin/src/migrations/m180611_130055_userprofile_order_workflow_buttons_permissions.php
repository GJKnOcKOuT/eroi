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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWorkflow;
use \arter\amos\admin\models\UserProfile;
use yii\helpers\ArrayHelper;


/**
 * Class m180611_130055_userprofile_order_workflow_buttons_permissions
 */
class m180611_130055_userprofile_order_workflow_buttons_permissions extends AmosMigrationWorkflow
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return ArrayHelper::merge(parent::setWorkflow(), [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => UserProfile::USERPROFILE_WORKFLOW,
                'status_id' => 'VALIDATED',
                'key' => 'order',
                'value' => '4'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => UserProfile::USERPROFILE_WORKFLOW,
                'status_id' => 'NOTVALIDATED',
                'key' => 'order',
                'value' => '3'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => UserProfile::USERPROFILE_WORKFLOW,
                'status_id' => 'DRAFT',
                'key' => 'order',
                'value' => '1'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => UserProfile::USERPROFILE_WORKFLOW,
                'status_id' => 'TOVALIDATE',
                'key' => 'order',
                'value' => '2'
            ],
        ]);
    }
}
