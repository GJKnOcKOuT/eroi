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


namespace arter\amos\een\assets;

use yii\web\AssetBundle;

/**
 * Class ProposteCollaborazioneEenAsset
 * @package arter\amos\een\assets
 */
class ProposteCollaborazioneEenAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-proposte-collaborazione-een/src/assets/web';

    public $js = [
    ];

    public $css = [
        'less/proposte-een.less',
    ];

    public $depends = [

    ];


    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if(!empty($moduleL))
        { $this->depends [] = 'arter\amos\layout\assets\BaseAsset'; }
        else
        { $this->depends [] = 'arter\amos\core\views\assets\AmosCoreAsset'; }
        parent::init();
    }
}