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

use cornernote\workflow\manager\models\Status;
use arter\amos\core\migration\libs\common\MigrationCommon;
use yii\db\Migration;

/**
 * Class m180411_162621_modify_news_metadata_3
 */
class m180411_162621_modify_news_metadata_3 extends Migration
{
    const WORKFLOW_NAME = 'NewsWorkflow';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->updateStatus('BOZZA', 'Bozza');
        $this->updateStatus('DAVALIDARE', 'In richiesta di pubblicazione');
        $this->updateStatus('VALIDATO', 'Pubblicata');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->updateStatus('BOZZA', 'Modifica in corso');
        $this->updateStatus('DAVALIDARE', 'Richiedi pubblicazione');
        $this->updateStatus('VALIDATO', 'Validato');
    }

    /**
     * @param string $status
     * @param string $label
     * @return bool
     */
    private function updateStatus($status, $label)
    {
        try {
            $this->update(Status::tableName(), ['label' => $label], [
                'workflow_id' => self::WORKFLOW_NAME,
                'id' => $status
            ]);
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage('Errore durante aggiornamento stato workflow: workflow = ' . self::WORKFLOW_NAME . '; status = ' . self::WORKFLOW_NAME . '/' . $status . '; label = ' . $label . ';');
            return false;
        }
        MigrationCommon::printConsoleMessage("Aggiornamento stato workflow eseguito correttamente: workflow = " . self::WORKFLOW_NAME . "; status = " . self::WORKFLOW_NAME . '/' . $status . '; label = ' . $label . ';');
        return true;
    }
}
