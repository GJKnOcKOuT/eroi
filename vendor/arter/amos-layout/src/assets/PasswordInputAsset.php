<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @licence GPLv3
 * @licence https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package amos-layout
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
namespace arter\amos\layout\assets;

use yii\web\AssetBundle;

class PasswordInputAsset extends AssetBundle
{
    public $css = [
        'less/password-input.less',
    ];
    public $js = [
        'js/password-input.js',
    ];
    public $depends = [
        //'arter\amos\layout\assets\BaseAsset'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/resources/password-input';

        parent::init();
    }
}
