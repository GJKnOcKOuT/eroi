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
 * @package    arter\amos\comments\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comments\assets;

use yii\web\AssetBundle;

/**
 * Class CommentsAsset
 * @package arter\amos\comments\assets
 */
class CommentsBootstrapitaliaAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-comments/src/assets/web';

    /**
     * @inheritdoc
     */
    public $css = [
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/comments_bootstrapitalia.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}