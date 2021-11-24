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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\faq;

use arter\amos\core\module\AmosModule;
use arter\amos\faq\widgets\icons\WidgetIconFaq;
use arter\amos\core\interfaces\CmsModuleInterface;
use yii\console\Application;

/**
 * Class AmosFaq
 * @package arter\amos\faq
 */
class AmosFaq extends AmosModule implements CmsModuleInterface
{
    public $controllerNamespace = 'arter\amos\faq\controllers';
    public $name = 'FAQ';

    public static function getModuleName()
    {
        return 'faq';
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('amos/faq/' . $category, $message, $params, $language);
    }



    public function init()
    {
        parent::init();

        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        $this->registerTranslations();

    }

    public function registerTranslations()
    {
        $translationConfiguration = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => \Yii::$app->language,
            'basePath' => '@vendor/arter/amos-faq/src/messages',
            'fileMap' => [
                'amos/faq/app' => 'app.php',
            ],
        ];

        if (!YII_ENV_PROD) {
            $translationConfiguration['on missingTranslation'] = ['arter\amos\faq\components\TranslationEventHandler', 'handleMissingTranslation'];
        }

        \Yii::$app->getI18n()->translations['amos/faq/*'] = $translationConfiguration;

    }

    public function getWidgetGraphics()
    {

    }

    public function getWidgetIcons()
    {
        return [
            WidgetIconFaq::className(),
        ];
    }

    /**
     * Get default model classes
     */
    protected function getDefaultModels()
    {
        return [
            'Faq' => __NAMESPACE__ . '\\' . 'models\\Faq',
        ];
    }
    
    /****
     * CmsModuleInterface
     */
     public static function getModelSearchClassName() {
        return __NAMESPACE__.'\models\FaqSearch';
    }

    public static function getModelClassName() {
        return __NAMESPACE__ . '\models\Faq';
    }
}
