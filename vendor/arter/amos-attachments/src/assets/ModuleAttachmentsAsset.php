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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\attachments\assets;

use yii\web\AssetBundle;
use arter\amos\core\widget\WidgetAbstract;

class ModuleAttachmentsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-attachments/src/assets/web';

    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
    ];

    public function init()
    {

        if (!empty(\Yii::$app->params['bsVersion']) && \Yii::$app->params['bsVersion'] == '4.x') {

        } else {
            if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
                $this->css = ['less/attachments_fullsize.less'];
            } else {
                $this->css = ['less/attachments.less'];
            }
        }

        parent::init();
    }
}