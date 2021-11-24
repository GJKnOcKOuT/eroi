<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace lajax\translatemanager\controllers\actions;

use lajax\translatemanager\models\Language;
use lajax\translatemanager\services\Generator;
use Yii;
use yii\web\UploadedFile;
use lajax\translatemanager\models\ImportForm;

/**
 * Class for exporting translations.
 */
class ImportAction extends \yii\base\Action
{
    /**
     * Show import form and import the uploaded file if posted
     *
     * @return string
     *
     * @throws \Exception
     */
    public function run()
    {
        $model = new ImportForm();

        if (Yii::$app->request->isPost) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');

            if ($model->validate()) {
                try {
                    $result = $model->import();

                    $message = Yii::t('language', 'Successfully imported {fileName}', ['fileName' => $model->importFile->name]);
                    $message .= "<br/>\n";
                    foreach ($result as $type => $typeResult) {
                        $message .= "<br/>\n" . Yii::t('language', '{type}: {new} new, {updated} updated', [
                            'type' => $type,
                            'new' => $typeResult['new'],
                            'updated' => $typeResult['updated'],
                        ]);
                    }

                    $languageIds = Language::find()
                        ->select('language_id')
                        ->where(['status' => Language::STATUS_ACTIVE])
                        ->column();

                    foreach ($languageIds as $languageId) {
                        $generator = new Generator($this->controller->module, $languageId);
                        $generator->run();
                    }

                    Yii::$app->getSession()->setFlash('success', $message);
                } catch (\Exception $e) {
                    if (YII_DEBUG) {
                        throw $e;
                    } else {
                        Yii::$app->getSession()->setFlash('danger', str_replace("\n", "<br/>\n", $e->getMessage()));
                    }
                }
            }
        }

        return $this->controller->render('import', [
            'model' => $model,
        ]);
    }
}
