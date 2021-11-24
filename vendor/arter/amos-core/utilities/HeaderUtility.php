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
 * @package    arter\amos\core\utilities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\utilities;

use arter\amos\core\exceptions\AmosException;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\module\Module;
use lajax\translatemanager\models\Language;
use Yii;

/**
 * Class HeaderUtility
 * @package arter\amos\core\utilities
 */
class HeaderUtility
{

    /**
     *
     * @return array
     */
    public static function getTranslationMenu()
    {
        try {
            $voceMenu = [];
            if (
                \Yii::$app->getModule('translatemanager') && isset(Yii::$app->params['languageSelector']) && Yii::$app->params['languageSelector']
                && isset(Yii::$app->language)
            ) {
                $translateManager = new Language();
                $table            = $translateManager->getTableSchema()->name;

                $activeLanguage = self::getActiveLanguages($table);
                $languages      = (!empty($activeLanguage) ? $activeLanguage : []);

                if (!empty($languages)) {


                    foreach ($languages as $Lang) {
                        $voceMenu[] = \yii\helpers\Html::a(
                            \yii\helpers\Html::tag('span', $Lang['name']),
                            [(!empty(\Yii::$app->getModule('translation')->actionLanguage) ? \Yii::$app->getModule('translation')->actionLanguage
                                : '/site/language')],
                            [
                                'data' => [
                                    'params' => ['language' => $Lang['language_id']],
                                    'method' => 'post'
                                ],
                                'class' => 'list-item',
                                'title' => Module::t('amosplanner', 'Cambia lingua in'.' '.$Lang['name'])
                            ]
                        );
                    }
                }
                /*       if (Yii::$app->getUser()->can('TRANSLATION_ADMINISTRATOR')) {
                  $arrayLang[] = (!empty($languages)) ? '<li class="divider"></li>' : '';
                  $arrayLang[] = '<li class="dropdown-header">'.Yii::t('amoscore', 'Amministra le traduzioni').'</li>';
                  $arrayLang[] = '<li class="divider"></li>';
                  $arrayLang[] = [
                  'label' => Yii::t('amoscore', 'Lista delle lingue'),
                  'url' => ['/translatemanager/language/list'],
                  ];
                  $arrayLang[] = [
                  'label' => Yii::t('amoscore', 'Crea una nuova lingua'),
                  'url' => ['/translatemanager/language/create'],
                  ];
                  $arrayLang[] = [
                  'label' => Yii::t('amoscore', 'Fai una scansione'),
                  'url' => ['/translatemanager/language/scan'],
                  ];
                  $arrayLang[] = [
                  'label' => Yii::t('amoscore', 'Ottimizza le tabelle'),
                  'url' => ['/translatemanager/language/optimizer'],
                  ];
                  } */
                return $voceMenu;
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Return array of languages
     * @param string $table
     * @return array
     */
    protected static function getActiveLanguages($table)
    {
        try {
            $language  = new \lajax\translatemanager\models\Language;
            $arrayLang = [];

            if (Yii::$app->db->schema->getTableSchema($table, false) != null) {
                if (\Yii::$app->user->can('CONTENT_TRANSLATOR')) {
                    $arrayLang = (new \yii\db\Query())->from($table)->andWhere(['>=', 'status', 1])->select([
                        'language_id',
                        'name'
                    ])->all();
                } else {
                    $arrayLang = (new \yii\db\Query())->from($table)->andWhere(['=', 'status', 1])->select([
                        'language_id',
                        'name'
                    ])->all();
                }
            }
            return $arrayLang;
        } catch (\Exception $e) {
            return NULL;
        }
    }

    /**
     *
     * @return string
     */
    public static function getAppLanguage()
    {
        $posLang   = strpos(Yii::$app->language, '-');
        $labelLang = strtoupper(substr(Yii::$app->language, 0, $posLang));
        return $labelLang;
    }
}
