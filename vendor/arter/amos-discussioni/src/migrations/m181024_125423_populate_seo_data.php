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


use arter\amos\discussioni\models\DiscussioniTopic;
use arter\amos\seo\models\SeoData;
use yii\db\Migration;

/**
 * Class m181024_125423_populate_seo_data */
class m181024_125423_populate_seo_data extends Migration {

    public function safeUp() {
        $totsave = 0;
        $totnotsave = 0;
        try {
            foreach (DiscussioniTopic::find()
                    ->orderBy(['id' => SORT_ASC])
                    ->all() as $discussione) {

                $seoData = SeoData::findOne([
                            'classname' => $discussione->className(),
                            'content_id' => $discussione->id
                ]);

                if (is_null($seoData)) {
                    $seoData = new SeoData();
                    $pars = [];
                    $pars = ['pretty_url' => $discussione->slug,
                        'meta_title' => '',
                        'meta_description' => '',
                        'meta_keywords' => '',
                        'og_title' => '',
                        'og_description' => '',
                        'og_type' => '',
                        'unavailable_after_date' => '',
                        'meta_robots' => '',
                        'meta_googlebot' => ''
                    ];
                    $seoData->aggiornaSeoData($discussione, $pars);
                    $totsave++;
                } else {
                    $totnotsave++;
                }
            }
            \yii\helpers\Console::stdout("Records Seo_data save: $totsave\n\n");
            \yii\helpers\Console::stdout("Records Seo_data already present: $totnotsave\n\n");
        } catch (Exception $ex) {
            \yii\helpers\Console::stdout("Module Seo not configured " . $ex->getMessage());
        }
        return true;
    }

    public function safeDown() {
        $totdel = 0;
        try {
            foreach (DiscussioniTopic::find()
                    ->orderBy(['id' => SORT_ASC])
                    ->all() as $discussione) {

                $where = " classname LIKE '" . addslashes(addslashes($discussione->className())) . "' AND content_id = " . $discussione->id;
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
