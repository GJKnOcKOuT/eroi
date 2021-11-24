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

use yii\helpers\StringHelper;
/**
 * Customizable controller class.
 */
echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) . '\api' ?>;

/**
* This is the class for REST controller "<?= $controllerClassName ?>".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class <?= $controllerClassName ?> extends \yii\rest\ActiveController
{
public $modelClass = '<?= $generator->modelClass ?>';
<?php if ($generator->accessFilter): ?>
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
    return ArrayHelper::merge(
    parent::behaviors(),
    [
    'access' => [
    'class' => AccessControl::className(),
    'rules' => [
    [
    'allow' => true,
    'matchCallback' => function ($rule, $action) {return \Yii::$app->user->can($this->module->id . '_' . $this->id . '_' . $action->id, ['route' => true]);},
    ]
    ]
    ]
    ]
    );
    }
<?php endif; ?>
}
