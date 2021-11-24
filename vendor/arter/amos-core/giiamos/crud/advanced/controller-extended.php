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
 * @package    arter\amos\core\giiamos\crud\wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;

/**
 * Customizable controller class.
 */
echo "<?php\n";
?>

/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * OPEN 2.0
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\'))?> 
 * @author     Elite Division S.r.l.
 */
 
namespace <?= \yii\helpers\StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

/**
 * Class <?= $controllerClassName ?> 
 * This is the class for controller "<?= $controllerClassName ?>".
 * @package <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?> 
 */
class <?= $controllerClassName ?> extends \<?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')).'\base\\'.$controllerClassName."\n" ?>
{

}
