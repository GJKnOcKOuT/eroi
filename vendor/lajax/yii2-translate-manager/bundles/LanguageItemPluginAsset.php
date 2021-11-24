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


namespace lajax\translatemanager\bundles;

use yii\web\AssetBundle;

/**
 * Contains the translated javascript messages for the current language.
 *
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */
class LanguageItemPluginAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@lajax/translatemanager/assets';

    /**
     * @inheritdoc
     */
    public $publishOptions = [
        'forceCopy' => true,
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = \Yii::$app->getModule('translatemanager')->getLanguageItemsDirPath();
        $language = \Yii::$app->language;

        if (file_exists(\Yii::getAlias($this->sourcePath . $language . '.js'))) {
            $this->js = [$language . '.js'];
        } else {
            $this->sourcePath = null;
        }

        parent::init();
    }
}
