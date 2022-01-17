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
 * @package    console\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\best\practice\console;

use arter\amos\best\practice\models\BestPractice;
use arter\amos\core\behaviors\BlameableBehavior;
use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\core\utilities\SpreadSheetFactory;
use arter\amos\tag\models\EntitysTagsMm;
use arter\amos\tag\models\Tag;
use yii\console\Controller as ConsoleController;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * Class ImportController
 * @package console\controllers
 */
class ImportController extends ConsoleController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionImport()
    {
        set_time_limit(0);

        $this->importBestpracticeRaw();
        MigrationCommon::printConsoleMessage('Imported Supercraft raw');

        $this->importBestpractice();
        MigrationCommon::printConsoleMessage('Imported Supercraft');

    }

    public function actionImportRaw()
    {
        set_time_limit(0);

        $this->importBestpracticeRaw();
        MigrationCommon::printConsoleMessage('Imported Bestpractice raw');
    }

    public function actionImportBestPractice()
    {
        set_time_limit(0);

        $this->importBestpractice();
    }

    public function importBestPracticeRaw()
    {
        SpreadSheetFactory::createImportAndSaveDynamic(
            "prova",//Foglio di lavoro nel file
            \Yii::getAlias("@app") . DIRECTORY_SEPARATOR . "toimport" . DIRECTORY_SEPARATOR . "prova.xlsx",
            "import_raw_bestpractice",
            [
                'title',
                'facilitatortext',
                'facilitatororganizationtext',
                'userstext',
                'synthesis',
                'tag',
                'trdoclink'
            ]);
    }

    protected function importBestPractice()
    {
        $query = new Query();
        $query->from('import_raw_bestpractice');
        $rawBestpractices = $query->all();

        foreach ($rawBestpractices as $rawBestpractice) {
            if (!$rawBestpractice['title']) {
                continue;
            }
            $bestpractice = new BestPractice();
            $bestpractice->detachBehaviorByClassName(BlameableBehavior::className());
            $bestpractice->detachBehavior('workflow');
            $bestpractice->title = $rawBestpractice['title'];
            $bestpractice->synthesis = $rawBestpractice['synthesis'];
            $bestpractice->facilitator_text = $rawBestpractice['facilitatortext'];
            $bestpractice->facilitator_organization_text = $rawBestpractice['facilitatororganizationtext'];
            $bestpractice->users_text = $rawBestpractice['userstext'];
            $bestpractice->tr_doc_link = $rawBestpractice['trdoclink'];
            $bestpractice->validated_at_least_once = 1;
            $bestpractice->status = BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED;
            $bestpractice->created_by = 1;
            $bestpractice->updated_by = 1;
            $ok = $bestpractice->save(false);
            if (!$ok) {
                MigrationCommon::printCheckStructureError($bestpractice->attributes, 'errore salvataggio best practice');
                break;
            }

            unset($bestpractice);
        }
    }

    public function actionImportTags()
    {
        set_time_limit(0);

        $query = new Query();
        $query->from('import_raw_bestpractice');
        $rawBestpractices = $query->all();

        $allOk = true;
        foreach ($rawBestpractices as $rawBestpractice) {
            if (!$rawBestpractice['title']) {
                continue;
            }
            $bestpractice = BestPractice::find()->andWhere(['title' => $rawBestpractice['title']])->one();
            if (is_null($bestpractice)) {
                MigrationCommon::printConsoleMessage('Best Practice non trovata; Title =' . $rawBestpractice['title']);
                $allOk = false;
                continue;
            }
            $tag = Tag::findOne($rawBestpractice['tag']);
            if (is_null($tag)) {
                $allOk = false;
                MigrationCommon::printConsoleMessage('Tag non trovato; Id =' . $rawBestpractice['tag']);
                continue;
            }
            $ok = $this->findAndCreateEntityTagsMm($bestpractice, $tag);
            if (!$ok) {
                $allOk = false;
                MigrationCommon::printConsoleMessage('Errore creazione associazione fra BestPractice title = ' . $rawBestpractice['title'] . ' e Tag = ' . $rawBestpractice['tag']);
            }
            unset($bestpractice);
            unset($tag);
        }

        if ($allOk) {
            MigrationCommon::printConsoleMessage('Importazione andata a buon fine');
        } else {
            MigrationCommon::printConsoleMessage("Errori durante l'importazione dei tag");
        }
    }

    /**
     * @param BestPractice $model
     * @param Tag $tag
     * @return bool
     */
    public function createEntityTagsMm($model, $tag)
    {
        $entityTagsMm = new EntitysTagsMm();
        $entityTagsMm->classname = $model->className();
        $entityTagsMm->record_id = $model->id;
        $entityTagsMm->tag_id = $tag->id;
        $entityTagsMm->root_id = $tag->root;
        $ok = $entityTagsMm->save();
        return $ok;
    }

    /**
     * @param BestPractice $model
     * @param Tag $tag
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function findAndCreateEntityTagsMm($model, $tag)
    {
        /** @var ActiveQuery $query */
        $query = EntitysTagsMm::find();
        $query->andWhere(['root_id' => $tag->root]);
        $query->andWhere(['record_id' => $model->id]);
        $query->andWhere(['tag_id' => $tag->id]);
        $query->andWhere(['classname' => $model->className()]);
        $entityTagsMms = $query->all();
        $ok = true;
        if (!count($entityTagsMms)) {
            $ok = $this->createEntityTagsMm($model, $tag);
        }
        return $ok;
    }
}
