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

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\jui;

use yii\helpers\Html;

/**
 * ProgressBar renders an progressbar jQuery UI widget.
 *
 * For example:
 *
 * ```php
 * echo ProgressBar::widget([
 *     'clientOptions' => [
 *         'value' => 75,
 *     ],
 * ]);
 * ```
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the widget container:
 *
 * ~~~php
 * ProgressBar::begin([
 *     'clientOptions' => ['value' => 75],
 * ]);
 *
 * echo '<div class="progress-label">Loading...</div>';
 *
 * ProgressBar::end();
 * ~~~
 * @see http://api.jqueryui.com/progressbar/
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class ProgressBar extends Widget
{
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        echo Html::beginTag('div', $this->options) . "\n";
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::endTag('div') . "\n";
        $this->registerWidget('progressbar');
    }
}
