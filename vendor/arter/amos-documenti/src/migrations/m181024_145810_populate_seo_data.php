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


use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use arter\amos\seo\models\SeoData;
use yii\db\Migration;

/**
 * Class m181024_145810_populate_seo_data */
class m181024_145810_populate_seo_data extends Migration {

    public function safeUp() {
        $totsave = 0;
        $totnotsave = 0;
        try {
            /** @var Documenti $documentiModel */
            $documentiModel = AmosDocumenti::instance()->createModel('Documenti');
            foreach ($documentiModel::find()
                    ->orderBy(['id' => SORT_ASC])
                    ->all() as $document) {
                /** @var Documenti $document */
                $seoData = SeoData::findOne([
                            'classname' => $document->className(),
                            'content_id' => $document->id
                ]);

                if (is_null($seoData)) {
                    $seoData = new SeoData();
                    $pars = [];
                    $pars = ['pretty_url' => yii\helpers\Inflector::slug($document->titolo),
                        'meta_title' => '',
                        'meta_description' => '',
                        'meta_keywords' => '',
                        'og_title' => '',
                        'og_description' => '',
                        'og_type' => '',
                        'unavailable_after_date' => '',
                        'meta_robots' => '',
                        'meta_googlebot' => ''];
                    $seoData->aggiornaSeoData($document, $pars);
                    $totsave++;
                } else {
                    $totnotsave++;
                }
            }
            \yii\helpers\Console::stdout("Records Seo_data Documenti save: $totsave\n\n");
            \yii\helpers\Console::stdout("Records Seo_data Documenti already present: $totnotsave\n\n");
        } catch (Exception $ex) {
            \yii\helpers\Console::stdout("Error transaction Documenti " . $ex->getMessage());
        }
        return true;
    }

    public function safeDown() {
        $totdel = 0;
        try {
            /** @var Documenti $documentiModel */
            $documentiModel = AmosDocumenti::instance()->createModel('Documenti');
            foreach ($documentiModel::find()
                    ->orderBy(['id' => SORT_ASC])
                    ->all() as $document) {
                /** @var Documenti $document */
                $where = " classname LIKE '" . addslashes(addslashes($document->className())) . "' AND content_id = " . $document->id;
                $this->delete(SeoData::tableName(), $where);

                $totdel++;
            }
            \yii\helpers\Console::stdout("Records Seo_data delete: $totdel\n\n");
        } catch (Exception $ex) {
            \yii\helpers\Console::stdout("Module Seo not configured " . $ex->getMessage());
        }
        return true;
    }

}
