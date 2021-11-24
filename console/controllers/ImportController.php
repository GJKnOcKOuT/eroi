<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    console\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace console\controllers;

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\core\utilities\SpreadSheetFactory;
use yii\console\Controller as ConsoleController;
use yii\db\Query;

/**
 * Class ImportController
 * @package console\controllers
 */
class ImportController extends ConsoleController
{
    private $toImportTableName = 'import_update_translations';
    
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
    
    public function actionUpdateTranslations()
    {
        set_time_limit(0);
    
        SpreadSheetFactory::createImportAndSaveDynamic(
            "Sheet1",
            \Yii::getAlias("@console") . DIRECTORY_SEPARATOR . "toimport" . DIRECTORY_SEPARATOR . "update_rifiut.xlsx",
            $this->toImportTableName,
            [
                'id',
                'translation',
            ]
        );
        
        $query = new Query();
        $query->from($this->toImportTableName);
        $translations = $query->all();
    
        foreach ($translations as $translation) {
            \Yii::$app->db->createCommand()->update(
                'language_translate',
                ['translation' => $translation['translation']],
                ['id' => $translation['id'], 'language' => 'it-IT']
            )->execute();
        }
    }
}
