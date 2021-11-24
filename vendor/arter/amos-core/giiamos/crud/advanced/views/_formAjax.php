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
 * @package    arter\amos\core\giiamos\crud\wizard\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
 
/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */
/** @var \yii\db\ActiveRecord $model */
$model = new $generator->modelClass;
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

$itemsTab = [];
$arrClassModel = explode('\\', $generator->modelClass);
$classModel = end($arrClassModel);

echo "<?php\n".
 "/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * OPEN 2.0
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    " . StringHelper::dirname(ltrim($generator->viewPath, '\\')) . "/views"." 
 * @author     Elite Division S.r.l.
 */";
?>

use arter\amos\core\helpers\Html;
use arter\amos\core\forms\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\CloseSaveButtonWidget;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use arter\amos\core\icons\AmosIcons;
use yii\bootstrap\Modal;

/**
* @var yii\web\View $this
* @var <?= ltrim($generator->modelClass, '\\') ?> $model
* @var yii\widgets\ActiveForm $form
*/
?>
<?php
$ajaxForm = FALSE;
$descriptionAttribute = "";

foreach ((array) $generator->getMmRelations() as $Relation){
//    pr($generator->getMmRelations());die;
    if (Inflector::id2camel($Relation['toEntity'], '_') == $classModel){
        $ajaxForm = TRUE;
        $descriptionAttribute = ucfirst($Relation['descriptorField']);
        continue;
    }
}
?>
<?= "<?=" ?> $this->render('_form', [
    'model' => $model,
    'fid' => (NULL !== (filter_input(INPUT_GET, 'fid')))? filter_input(INPUT_GET, 'fid') : '',
    'dataField' => (NULL !== (filter_input(INPUT_GET, 'dataField')))? filter_input(INPUT_GET, 'dataField') : '',
    'dataEntity' => (NULL !== (filter_input(INPUT_GET, 'dataEntity')))? filter_input(INPUT_GET, 'dataEntity') : '',
    'class' => 'dynamicCreation'
]) <?= "?>" ?>