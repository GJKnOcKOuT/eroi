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
 * @package    arter\amos\ticket\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\assets;

use arter\amos\core\widget\WidgetAbstract;
use yii\web\AssetBundle;

/**
 * Class TicketAsset
 * @package arter\amos\ticket\assets
 */
class TicketAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-ticket/src/assets/web';

    /**
     * @inheritdoc
     */
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'less/ticket.less',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/ticket.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->css = ['less/ticket_fullsize.less'];
        }

        parent::init();
    }
}
