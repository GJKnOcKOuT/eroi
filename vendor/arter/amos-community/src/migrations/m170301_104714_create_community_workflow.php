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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\models\Community;

/**
 * Class m170301_104714_create_community_workflow
 */
class m170301_104714_create_community_workflow extends \yii\db\Migration
{

    const TABLE_WORKFLOW = '{{%sw_workflow}}';
    const TABLE_WORKFLOW_STATUS = '{{%sw_status}}';
    const TABLE_WORKFLOW_TRANSITIONS = '{{%sw_transition}}';
    const TABLE_WORKFLOW_METADATA = '{{%sw_metadata}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->insert(self::TABLE_WORKFLOW, [
            'id' => Community::COMMUNITY_WORKFLOW,
            'initial_status_id' => 'DRAFT'
        ]);

        $this->batchInsert(self::TABLE_WORKFLOW_STATUS,
            [
                'id',
                'workflow_id',
                'label',
                'sort_order'
            ],
            [
                [
                    'DRAFT',
                    Community::COMMUNITY_WORKFLOW,
                    'Editing in progress',
                    0
                ],
                [
                    'TOVALIDATE',
                    Community::COMMUNITY_WORKFLOW,
                    'To validate',
                    1
                ],
                [
                    'VALIDATED',
                    Community::COMMUNITY_WORKFLOW,
                    'Validated',
                    2
                ],
                [
                    'NOTVALIDATED',
                    Community::COMMUNITY_WORKFLOW,
                    'Not validated',
                    3
                ]
            ]);
        $this->batchInsert(self::TABLE_WORKFLOW_TRANSITIONS,
            [
                'workflow_id',
                'start_status_id',
                'end_status_id'
            ],
            [
                [
                    Community::COMMUNITY_WORKFLOW,
                    'DRAFT',
                    'TOVALIDATE'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'DRAFT',
                    'VALIDATED'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'TOVALIDATE',
                    'VALIDATED'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'TOVALIDATE',
                    'NOTVALIDATED'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'VALIDATED',
                    'DRAFT'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'NOTVALIDATED',
                    'DRAFT'
                ],
            ]);
        $this->batchInsert(self::TABLE_WORKFLOW_METADATA,
            [
                'workflow_id',
                'status_id',
                'key',
                'value'
            ],
            [
                //metadata DRAFT status
                [
                    Community::COMMUNITY_WORKFLOW,
                    'DRAFT',
                    'class',
                    'btn btn-navigation-primary'

                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'DRAFT',
                    'description',
                    'Community editing in progress'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'DRAFT',
                    'label',
                    'Editing in progress'
                ],
                //metadata TOVALIDATE status
                [
                    Community::COMMUNITY_WORKFLOW,
                    'TOVALIDATE',
                    'class',
                    'btn btn-navigation-primary'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'TOVALIDATE',
                    'description',
                    'Submit the Community to validation'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'TOVALIDATE',
                    'label',
                    'To validate'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'TOVALIDATE',
                    'message',
                    'Submit this Community to validation?'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'TOVALIDATE',
                    'order',
                    '1'
                ],
                //metadata VALIDATED status
                [
                    Community::COMMUNITY_WORKFLOW,
                    'VALIDATED',
                    'class',
                    'btn btn-navigation-primary'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'VALIDATED',
                    'description',
                    'The Community will be validated'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'VALIDATED',
                    'label',
                    'Validated'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'VALIDATED',
                    'message',
                    'Validate this Community?'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'VALIDATED',
                    'order',
                    '2'
                ],
                //metadata NOTVALIDATED status
                [
                    Community::COMMUNITY_WORKFLOW,
                    'NOTVALIDATED',
                    'class',
                    'btn btn-navigation-primary'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'NOTVALIDATED',
                    'description',
                    'The Community will not be validated'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'NOTVALIDATED',
                    'label',
                    'Not validated'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'NOTVALIDATED',
                    'message',
                    'Do not validate this Community?'
                ],
                [
                    Community::COMMUNITY_WORKFLOW,
                    'NOTVALIDATED',
                    'order',
                    '3'
                ],
            ]);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete(self::TABLE_WORKFLOW_METADATA, ['workflow_id' => Community::COMMUNITY_WORKFLOW]);
        $this->delete(self::TABLE_WORKFLOW_TRANSITIONS, ['workflow_id' => Community::COMMUNITY_WORKFLOW]);
        $this->delete(self::TABLE_WORKFLOW_STATUS, ['workflow_id' => Community::COMMUNITY_WORKFLOW]);
        $this->delete(self::TABLE_WORKFLOW, ['id' => Community::COMMUNITY_WORKFLOW]);

        return true;
    }
}
