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


namespace yii2fullcalendar;

use Yii;
use yii\web\AssetBundle;

/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @author akorinek <https://github.com/akorinek>
 */

class SchedulerAsset extends AssetBundle
{
    public $sourcePath = '@bower/fullcalendar-scheduler/dist';
    
    /**
     * [$js description]
     * @var array
     */
    public $js = [
        'scheduler.js',
    ];
    
    public $css = [
        'scheduler.css'
    ];
}
