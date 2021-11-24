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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\events\AmosEvents;
use arter\amos\events\models\EventType;
use yii\db\ActiveQuery;
use yii\db\Migration;

/**
 * Class m190510_082640_fix_event_types_values_2
 */
class m190510_082640_fix_event_types_values_2 extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $this->alterColumn(EventType::tableName(), 'event_type', $this->integer(1)->null()->comment('Tipo di evento')->after('enabled'));
            $this->alterColumn(EventType::tableName(), 'limited_seats', $this->boolean()->notNull()->defaultValue(0)->comment('Posti limitati?')->after('event_type'));
            $this->alterColumn(EventType::tableName(), 'manage_subscritions_queue', $this->boolean()->notNull()->defaultValue(0)->comment('Gestione della coda di iscrizioni?')->after('limited_seats'));
            $this->alterColumn(EventType::tableName(), 'partners', $this->boolean()->notNull()->defaultValue(0)->comment('Iscrizione di accomapgnatori?')->after('manage_subscritions_queue'));
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore spostamento colonne tabella event_type');
            return false;
        }

        $allOk = true;
        try {
            /** @var AmosEvents $eventsModule */
            $eventsModule = AmosEvents::instance();
            /** @var EventType $eventTypeModel */
            $eventTypeModel = $eventsModule->createModel('EventType');
            /** @var ActiveQuery $query */
            $query = $eventTypeModel::find();
            $eventTypes = $query->all();
            foreach ($eventTypes as $eventType) {
                /** @var EventType $eventType */
                if ($eventType->event_type == 1) {
                    $eventType->event_type = EventType::TYPE_INFORMATIVE;
                } elseif ($eventType->event_type == 2) {
                    $eventType->event_type = EventType::TYPE_OPEN;
                } elseif ($eventType->event_type == 3) {
                    $eventType->event_type = EventType::TYPE_UPON_INVITATION;
                }
                if ($eventType->color == '#ffffff') {
                    $eventType->color = '#000000';
                }
                $ok = $eventType->save(false);
                if (!$ok) {
                    $allOk = false;
                }
            }
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento valori tabella event_type');
            return false;
        }

        if ($allOk) {
            MigrationCommon::printConsoleMessage('Tabella event_type aggiornata correttamente');
        } else {
            MigrationCommon::printConsoleMessage('Errore aggiornamento tabella event_type');
        }

        return $allOk;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $allOk = true;
        try {
            /** @var AmosEvents $eventsModule */
            $eventsModule = AmosEvents::instance();
            /** @var EventType $eventTypeModel */
            $eventTypeModel = $eventsModule->createModel('EventType');
            /** @var ActiveQuery $query */
            $query = $eventTypeModel::find();
            $eventTypes = $query->all();
            foreach ($eventTypes as $eventType) {
                /** @var EventType $eventType */
                if ($eventType->event_type == EventType::TYPE_INFORMATIVE) {
                    $eventType->event_type = 1;
                } elseif ($eventType->event_type == EventType::TYPE_OPEN) {
                    $eventType->event_type = 2;
                } elseif ($eventType->event_type == EventType::TYPE_UPON_INVITATION) {
                    $eventType->event_type = 3;
                }
                if ($eventType->color == '#000000') {
                    $eventType->color = '#ffffff';
                }
                $ok = $eventType->save(false);
                if (!$ok) {
                    $allOk = false;
                }
            }
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore aggiornamento valori tabella event_type');
            return false;
        }
        return $allOk;
    }
}
