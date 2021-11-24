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

namespace yii\base;

/**
 * WidgetEvent represents the event parameter used for a widget event.
 *
 * By setting the [[isValid]] property, one may control whether to continue running the widget.
 *
 * @author Petra Barus <petra.barus@gmail.com>
 * @since 2.0.11
 */
class WidgetEvent extends Event
{
    /**
     * @var mixed the widget result. Event handlers may modify this property to change the widget result.
     */
    public $result;
    /**
     * @var bool whether to continue running the widget. Event handlers of
     * [[Widget::EVENT_BEFORE_RUN]] may set this property to decide whether
     * to continue running the current widget.
     */
    public $isValid = true;
}
