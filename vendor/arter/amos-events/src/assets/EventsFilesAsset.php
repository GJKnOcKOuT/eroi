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
 * @package    arter\amos\events\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\assets;

use yii\web\AssetBundle;

/**
 * Class EventsFilesAsset
 * @package arter\amos\events\assets
 */
class EventsFilesAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-events/src/files/';
    public $baseUrl = '@web';
}
