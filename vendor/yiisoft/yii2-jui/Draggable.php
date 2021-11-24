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
 * Draggable renders an draggable jQuery UI widget.
 *
 * For example:
 *
 * ```php
 * Draggable::begin([
 *     'clientOptions' => ['grid' => [50, 20]],
 * ]);
 *
 * echo 'Draggable contents here...';
 *
 * Draggable::end();
 * ```
 *
 * @see http://api.jqueryui.com/draggable/
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class Draggable extends Widget
{
    /**
     * @inheritdoc
     */
    protected $clientEventMap = [
        'create' => 'dragcreate',
        'drag' => 'drag',
        'stop' => 'dragstop',
        'start' => 'dragstart',
    ];


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
        $this->registerWidget('draggable');
    }
}
