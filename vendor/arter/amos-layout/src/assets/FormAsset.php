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
 * @package    arter\amos\core
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\layout\assets;

use yii\web\AssetBundle;

class FormAsset extends AssetBundle
{
    public $css = [
        // TODO MOVE FROM BASE ASSET
        //'less/form.less',
    ];
    public $js = [
        'js/form.js',      
    ];
    public $depends = [
        //'arter\amos\layout\assets\BaseAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/resources/form';

        parent::init();
    }
}
