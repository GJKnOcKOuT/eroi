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

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use yii\db\ActiveQuery;
use yii\db\Migration;

/**
 * Class m181004_164409_delete_documenti_folder_contained_documents
 */
class m181004_164409_delete_documenti_folder_contained_documents extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $deletedFolders = $this->findDeletedFolders();
        $allOk = true;

        foreach ($deletedFolders as $deletedFolder) {
            try {
                $ok = $deletedFolder->deleteAllChildren(false);
            } catch (\Exception $exception) {
                MigrationCommon::printConsoleMessage("Errore cancellazione contenuto della cartella con id '" . $deletedFolder->id . "': '" . $deletedFolder->titolo . "'");
                MigrationCommon::printConsoleMessage($exception->getMessage());
                die();
            }
            if (!$ok) {
                MigrationCommon::printConsoleMessage("Errore cancellazione contenuto della cartella con id '" . $deletedFolder->id . "': '" . $deletedFolder->titolo . "'");
                $allOk = false;
            } else {
                MigrationCommon::printConsoleMessage("Cancellato contenuto della cartella con id '" . $deletedFolder->id . "': '" . $deletedFolder->titolo . "'");
            }
        }

        return $allOk;
    }

    /**
     * @return Documenti[]
     */
    private function findDeletedFolders()
    {
        /** @var Documenti $documentiModel */
        $documentiModel = AmosDocumenti::instance()->createModel('Documenti');

        /** @var ActiveQuery $query */
        $query = $documentiModel::basicFind();
        $query->andWhere(['is_folder' => Documenti::IS_FOLDER]);
        $query->andWhere(['is not', 'deleted_at', null]);
        $deletedFolders = $query->all();
        return $deletedFolders;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m181004_164409_delete_documenti_folder_contained_documents cannot be reverted.\n";
        return false;
    }
}
