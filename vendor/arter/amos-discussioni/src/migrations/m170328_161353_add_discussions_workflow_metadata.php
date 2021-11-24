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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWorkflow;
use arter\amos\discussioni\models\DiscussioniTopic;
use yii\helpers\ArrayHelper;

/**
 * Class m170328_161353_add_discussions_workflow_metadata
 */
class m170328_161353_add_discussions_workflow_metadata extends AmosMigrationWorkflow
{
    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return ArrayHelper::merge(parent::setWorkflow(), [
            // "Modifica in corso" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'description',
                'value' => 'Discussione in modifica'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'label',
                'value' => 'Modifica in corso'
            ],

            // "Da validare" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'description',
                'value' => 'Sottopone a validazione il documento'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'label',
                'value' => 'Da validare'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'message',
                'value' => 'Vuoi mettere in validazione questa discussione?'
            ],

            // "Validato" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'description',
                'value' => 'La discussione verrà validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'label',
                'value' => 'Validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'message',
                'value' => 'Vuoi validare questa discussione?'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'order',
                'value' => '1'
            ],

            // "Non validata" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'description',
                'value' => 'La discussione non verrà validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'label',
                'value' => 'Non validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'message',
                'value' => 'Vuoi non validare questa discussione?'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'order',
                'value' => '2'
            ]
        ]);
    }
}
