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


namespace softark\duallistbox;

use yii\web\AssetBundle;

/**
 * Asset bundle for yii2-dual-listbox Widget
 *
 * @author Nobuo Kihara <softark@gmail.comu>
 * @since 1.0
 */
class DualListboxAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/istvan-ujjmeszaros/bootstrap-duallistbox/dist';

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (YII_DEBUG) {
            $this->js = [
                'jquery.bootstrap-duallistbox.js',
            ];
            $this->css = [
                'bootstrap-duallistbox.css',
            ];
        } else {
            $this->js = [
                'jquery.bootstrap-duallistbox.min.js',
            ];
            $this->css = [
                'bootstrap-duallistbox.min.css',
            ];
        }
        parent::init();
    }
}
