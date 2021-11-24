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
 * @package    arter\amos\core\views\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views\assets;

use Yii;
use yii\web\AssetBundle;

class AmosCalendarCoreAsset extends AssetBundle
{
    /**
     * [$sourcePath description]
     * @var string
     */
    public $sourcePath = '@bower/fullcalendar/dist';

    /**
     * the language the calender will be displayed in
     * @var string ISO2 code for the wished display language
     */
    public $language = NULL;

    /**
     * [$autoGenerate description]
     * @var boolean
     */
    public $autoGenerate = true;

    /**
     * tell the calendar, if you like to render google calendar events within the view
     * @var boolean
     */
    public $googleCalendar = false;

    /**
     * [$css description]
     * @var array
     */
    public $css = [
        'fullcalendar.min.css',
    ];

    /**
     * [$js description]
     * @var array
     */
    public $js = [
        'locale-all.js',
    ];

    /**
     * [$depends description]
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii2fullcalendar\MomentAsset',
        'yii2fullcalendar\PrintAsset',
        'arter\amos\core\views\assets\AmosCalendarAsset',
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        $language = Yii::$app->language == 'it-IT' ? 'it' : strtolower(Yii::$app->language);
        //$language = $this->language ? $this->language : Yii::$app->language;
        if (strtoupper($language) != 'EN-US')
        {
            $this->js[] = strtolower("locale/{$language}.js");
        }

        if($this->googleCalendar)
        {
            $this->js[] = 'gcal.js';
        }

        parent::registerAssetFiles($view);
    }

}
