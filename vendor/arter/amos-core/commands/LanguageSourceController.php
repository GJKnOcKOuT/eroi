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
 * @package    arter\amos\core\commands
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\commands;

use arter\amos\core\module\AmosModule;
use lajax\translatemanager\models\Language;
use lajax\translatemanager\models\LanguageSource;
use lajax\translatemanager\models\LanguageTranslate;
use Yii;
use yii\console\Controller;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\log\Logger;

/**
 * Class LanguageSourceController
 * @package arter\amos\core\commands
 */
class LanguageSourceController extends Controller
{
    const FOLDER_NAME_LANGUAGE = "\\i18n\\";
    const FILE_NAME_LANGUAGE = 'messages.php';

    public $file_name_config = [
        'modules-amos.php',
        'modules-others.php'
    ];

    public $conf_path = [
        '@backend/config',
        '@common/config',
        '@console/config',
        '@frontend/config'
    ];

    public $forceUpdate = false;

    /**
     * @return array
     */
    public function options($actionID)
    {
        return ['forceUpdate'];
    }

    /**
     * @return int
     * @throws \yii\base\InvalidConfigException
     */
    public function actionLoadFiles()
    {
        foreach ($this->conf_path as $path) {
            $modules = $this->loadModules(\Yii::getAlias($path));
            foreach ($modules as $key => $module) {
                $mod = $this->isAmosModule($key, $module);
                if ($mod) {
                    $this->loadFiles($mod->getAmosUniqueId(), $mod->getI18nDirPath(), $this->forceUpdate);
                }
            }
        }

        $i18nComponent = \Yii::$app->get('i18n');
        if ($i18nComponent) {
            $confvars = [];
            if (is_object($i18nComponent->translations['*'])) {
                $confvars = $i18nComponent->translations['*']->extraCategoryPaths;
            } else {
                if (is_array($i18nComponent->translations['*'])) {
                    $confvars = $i18nComponent->translations['*']['extraCategoryPaths'];
                }
            }
            foreach ($confvars as $extraCategory => $extraPath) {
                $this->loadFiles($extraCategory, \Yii::getAlias($extraPath), $this->forceUpdate);
            }
        }
        if(!is_null(\Yii::$app->cache))
        {
            \Yii::$app->cache->flush();
        }
        return Controller::EXIT_CODE_NORMAL;
    }


    /**
     * @param $path
     * @return array
     */
    private function loadModules($path)
    {
        $configurations = [];

        try {
            $files = FileHelper::findFiles($path, [
                'only' => $this->file_name_config,
                'recursive' => true,
            ]);
            foreach ($files as $file) {
                $myArray = include $file;
                $configurations = ArrayHelper::merge($configurations, $myArray);
            }
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }

        return $configurations;
    }

    /**
     * @param string $path
     */
    private function loadFiles($category, $path = '', $forceUpdate = false)
    {
        try {
            if (is_dir($path)) {
                $files = FileHelper::findFiles($path, [
                    'only' => [self::FILE_NAME_LANGUAGE],
                    'recursive' => true,
                ]);
                $modifiedByUsers = [];
                $moduleTranslation = \Yii::$app->getModule('translation');
                if (!is_null($moduleTranslation) && class_exists('arter\amos\translation\models\LanguageTranslateUserFields')) {
                    /** @var \arter\amos\translation\AmosTranslation $moduleTranslation */
                    $query = new Query();
                    $query->select(new Expression("CONCAT(`language_translate_id`, '_', `language_translate_language`) AS language_translate"));
                    $query->from(\arter\amos\translation\models\LanguageTranslateUserFields::tableName());
                    $query->andWhere(['deleted_at' => null]);
                    $modifiedByUsers = $query->column();
                }
                foreach ($files as $file) {
                    $pathinfo = array_filter(explode(DIRECTORY_SEPARATOR, $file));
                    end($pathinfo);
                    $language = prev($pathinfo);
                    $myArray = include $file;
                    foreach ($myArray as $messageSource => $message) {
                        $this->alignDbAndTranslate($category, $message, $language, $messageSource, $forceUpdate, $modifiedByUsers);
                    }
                }
            }
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
    }

    /**
     * @param $category
     * @param $message
     * @param $language
     * @param $messageSource
     * @param bool $forceUpdate
     * @throws \Exception
     */
    protected function alignDbAndTranslate($category, $message, $language, $messageSource, $forceUpdate = false, $modifiedByUsers = [])
    {
        $currentTranslation = LanguageSource::findOne(['category' => $category, 'message' => $messageSource]);
        if (!$currentTranslation || !$currentTranslation->id) {
            $currentTranslation = new LanguageSource([
                'category' => $category,
                'message' => $messageSource
            ]);

            if (!$currentTranslation->validate()) {
                throw new \Exception('Unable to create language record, check validity');
            }
            $currentTranslation->save();
            $this->log('insert language_source : category ' . $category . ' message ' . $messageSource);
        }

        $languageModel = Language::findOne(['language_id' => $language]);
        if ($languageModel) {
            $translationExists = LanguageTranslate::findOne([
                'id' => $currentTranslation->id,
                'language' => $languageModel->language_id
            ]);
            if (!$translationExists || !$translationExists->id) {

                $newTranslation = new LanguageTranslate([
                    'id' => $currentTranslation->id,
                    'language' => $languageModel->language_id,
                    'translation' => $message
                ]);

                if ($newTranslation->validate()) {
                    $newTranslation->save();
                }
                $this->log('insert language_translate : *category*: ' . $category . ' *message*: ' . $messageSource);
            } else {
                if ($forceUpdate) {
                    $element = $translationExists->id . '_' . $language;
                    if (in_array($element, $modifiedByUsers)) {
                        $this->log('modified by user language_translate : *language*: ' . $language . ' *category*: ' . $category . ' *source*: ' . $messageSource . ' *message present*: ' . $translationExists->translation . ' *message new*: ' . $message);
                    } else {
                        $translationExists->translation = $message;
                        if ($translationExists->validate()) {
                            $translationExists->save();
                        }
                        $this->log('update language_translate : *category*: ' . $category . ' *message*: ' . $messageSource);
                    }
                } else {
                    $this->log('present language_translate : *language*: ' . $language . ' *category*: ' . $category . ' *source*: ' . $messageSource . ' *message present*: ' . $translationExists->translation . ' *message new*: ' . $message);
                }
            }
        }
    }

    /**
     * @param $key
     * @param $module
     * @return AmosModule|null
     * @throws \ReflectionException
     */
    private function isAmosModule($key, $module)
    {
        $amodModule = null;
        try {
            if (is_object($module)) {
                if ($module instanceof AmosModule) {
                    $amodModule = $module;
                }
            } else {
                $reflectionClass = new \ReflectionClass($module['class']);
                if ($reflectionClass->isSubclassOf(AmosModule::className())) {
                    $amodModule = \Yii::createObject($reflectionClass->getName(), [$key]);
                }
            }
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $amodModule;
    }

    /**
     * @param $message
     */
    private function log($message)
    {
        echo($message . "\n");
    }
}
