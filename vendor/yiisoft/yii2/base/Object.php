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

use Yii;

/**
 * Object is the base class that implements the *property* feature.
 *
 * It has been replaced by [[BaseObject]] in version 2.0.13 because `object` has become a reserved word which can not be
 * used as class name in PHP 7.2.
 *
 * Please refer to [[BaseObject]] for detailed documentation and to the
 * [UPGRADE notes](https://github.com/yiisoft/yii2/blob/2.0.13/framework/UPGRADE.md#upgrade-from-yii-2012)
 * on how to migrate your application to use [[BaseObject]] class to make your application compatible with PHP 7.2.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 * @deprecated since 2.0.13, the class name `Object` is invalid since PHP 7.2, use [[BaseObject]] instead.
 * @see https://wiki.php.net/rfc/object-typehint
 * @see https://github.com/yiisoft/yii2/issues/7936#issuecomment-315384669
 */
class Object extends BaseObject
{
}
