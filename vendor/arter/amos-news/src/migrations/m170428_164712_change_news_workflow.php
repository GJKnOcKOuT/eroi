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
 * @package    arter\amos\news\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;
use arter\amos\news\models\News;

/**
 * Class m170428_164712_change_news_workflow
 */
class m170428_164712_change_news_workflow extends Migration
{
    const TABLE_WORKFLOW_STATUS = '{{%sw_status}}';
    const TABLE_WORKFLOW_TRANSITIONS = '{{%sw_transition}}';
    const TABLE_WORKFLOW_METADATA = '{{%sw_metadata}}';

    public function safeUp()
    {
        /** Insert transition from status TOVALIDATE to status DRAFT */
        $this->insert(self::TABLE_WORKFLOW_TRANSITIONS,
            [
                'workflow_id' => News::NEWS_WORKFLOW,
                'start_status_id' => 'DAVALIDARE',
                'end_status_id' => 'BOZZA'
            ]);
        /**  find News in status not validated and replace the status with draft */
        $this->update(News::tableName(), ['status' => News::NEWS_WORKFLOW_STATUS_BOZZA],
            ['status' => News::NEWS_WORKFLOW_STATUS_NONVALIDATO]);

        /** delete status not validated from workflow tables */
        $this->delete(self::TABLE_WORKFLOW_METADATA, [
            'workflow_id' => News::NEWS_WORKFLOW,
            'status_id' => 'NONVALIDATO',
        ]);
        $this->delete(self::TABLE_WORKFLOW_TRANSITIONS, [
            'workflow_id' => News::NEWS_WORKFLOW,
            'start_status_id' => 'NONVALIDATO'
        ]);
        $this->delete(self::TABLE_WORKFLOW_TRANSITIONS, [
            'workflow_id' => News::NEWS_WORKFLOW,
            'end_status_id' => 'NONVALIDATO'
        ]);
        $this->delete(self::TABLE_WORKFLOW_STATUS, ['id' => 'NONVALIDATO', 'workflow_id' => News::NEWS_WORKFLOW]);

        return true;
    }

    public function safeDown()
    {
        $this->delete(self::TABLE_WORKFLOW_TRANSITIONS,
            [
                'workflow_id' => News::NEWS_WORKFLOW,
                'start_status_id' => 'DAVALIDARE',
                'end_status_id' => 'BOZZA'
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
                    'NONVALIDATO',
                    News::NEWS_WORKFLOW,
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
                    News::NEWS_WORKFLOW,
                    'DAVALIDARE',
                    'NONVALIDATO'
                ],
                [
                    News::NEWS_WORKFLOW,
                    'NONVALIDATO',
                    'BOZZA'
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
                //metadata NOTVALIDATED status
                [
                    'workflow_id' => News::NEWS_WORKFLOW,
                    'status_id' => 'NONVALIDATO',
                    '`key`' => 'class',
                    'value' => 'btn btn-navigation-primary'
                ],
                [
                    'workflow_id' => News::NEWS_WORKFLOW,
                    'status_id' => 'NONVALIDATO',
                    '`key`' => 'description',
                    'value' => 'La notizia non verrà validata'
                ],
                [
                    'workflow_id' => News::NEWS_WORKFLOW,
                    'status_id' => 'NONVALIDATO',
                    '`key`' => 'label',
                    'value' => 'Non validata'
                ],
                [
                    'workflow_id' => News::NEWS_WORKFLOW,
                    'status_id' => 'NONVALIDATO',
                    '`key`' => 'message',
                    'value' => 'Vuoi non validare questa notizia?'
                ],
                [
                    'workflow_id' => News::NEWS_WORKFLOW,
                    'status_id' => 'NONVALIDATO',
                    '`key`' => 'order',
                    'value' => '2'
                ]
            ]);
        return true;
    }
}
