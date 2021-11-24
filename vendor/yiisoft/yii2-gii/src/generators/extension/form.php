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

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\extension\Generator */

?>
<div class="alert alert-info">
    Please read the
    <?= \yii\helpers\Html::a('Extension Guidelines', 'http://www.yiiframework.com/doc-2.0/guide-structure-extensions.html', ['target'=>'new']) ?>
    before creating an extension.
</div>
<div class="module-form">
<?php
    echo $form->field($generator, 'vendorName');
    echo $form->field($generator, 'packageName');
    echo $form->field($generator, 'namespace');
    echo $form->field($generator, 'type')->dropDownList($generator->optsType());
    echo $form->field($generator, 'keywords');
    echo $form->field($generator, 'license')->dropDownList($generator->optsLicense(), ['prompt'=>'Choose...']);
    echo $form->field($generator, 'title');
    echo $form->field($generator, 'description');
    echo $form->field($generator, 'authorName');
    echo $form->field($generator, 'authorEmail');
    echo $form->field($generator, 'outputPath');
?>
</div>
