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


use pendalf89\filemanager\Module;
use pendalf89\filemanager\models\Tag;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
?>
<?php $form = ActiveForm::begin(['action' => '?', 'method' => 'get']) ?>
	<?= $form->field($model, 'tagIds')->widget(\kartik\select2\Select2::className(), [
		'maintainOrder' => true,
		'data' => ArrayHelper::map(Tag::find()->all(), 'id', 'name'),
		'options' => ['multiple' => true],
		'addon' => [
			'append' => [
				'content' => Html::submitButton(Module::t('main', 'Search'), ['class' => 'btn btn-primary']),
				'asButton' => true
			]
		]
	])->label(false) ?>
<?php ActiveForm::end() ?>
