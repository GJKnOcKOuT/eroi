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
use arter\amos\documenti\models\Documenti;
use yii\helpers\ArrayHelper;

/**
 * Class m170328_130621_add_documents_workflow_metadata
 */
class m170328_130621_add_documents_workflow_metadata extends AmosMigrationWorkflow
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
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'description',
                'value' => 'Documento in modifica'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'label',
                'value' => 'Modifica in corso'
            ],

            // "Da validare" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'description',
                'value' => 'Sottopone a validazione il documento'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'label',
                'value' => 'Da validare'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'message',
                'value' => 'Vuoi mettere in validazione questo documento?'
            ],

            // "Validato" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'VALIDATO',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'VALIDATO',
                'key' => 'description',
                'value' => 'Il documento verrà validato'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'VALIDATO',
                'key' => 'label',
                'value' => 'Validato'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'VALIDATO',
                'key' => 'message',
                'value' => 'Vuoi validare questo documento?'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'VALIDATO',
                'key' => 'order',
                'value' => '1'
            ],

            // "Non validato" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'NONVALIDATO',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'NONVALIDATO',
                'key' => 'description',
                'value' => 'Il documento non verrà validato'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'NONVALIDATO',
                'key' => 'label',
                'value' => 'Non validato'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'NONVALIDATO',
                'key' => 'message',
                'value' => 'Vuoi non validare questo documento?'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => Documenti::DOCUMENTI_WORKFLOW,
                'status_id' => 'NONVALIDATO',
                'key' => 'order',
                'value' => '2'
            ]
        ]);
    }
}
