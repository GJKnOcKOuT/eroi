<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use luya\web\Asset;
use Yii;

/**
 * Description of SocialAsset
 *
 * @author stefano
 */
class SocialAsset extends Asset
{
    public $sourcePath     = '@app/resources/social';
    public $css            = [
        'css/style.css'
    ];
    public $js             = [
    ];
    public $publishOptions = [
        'only' => [
            'css/*',
            'js/*',
        ]
    ];
    public $depends        = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        $moduleL = Yii::$app->getModule('layout');
        if (!empty($moduleL)) {
            $this->depends [] = 'arter\amos\layout\assets\IconAsset';
        } else {
            $this->depends [] = 'arter\amos\core\views\assets\AmosIconAsset';
        }
        parent::init();
    }
}