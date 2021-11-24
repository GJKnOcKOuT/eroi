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

namespace arter\amos\faq\assets;

use yii\web\AssetBundle;

class AmosFaqAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/arter/amos-faq/src/assets/web/';

    /**
     * @var array
     */
    public $css = [
        'less/faq.less',
    ];

    /**
     * @var array
     */
    public $js = [
    ];

    /**
     * @var array
     */
    public $depends = [
    ];

    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if(!empty($moduleL))
        { $this->depends [] = 'arter\amos\layout\assets\BaseAsset'; }
        else
        { $this->depends [] = 'arter\amos\core\views\assets\AmosCoreAsset'; }
        parent::init(); // TODO: Change the autogenerated stub
    }

}