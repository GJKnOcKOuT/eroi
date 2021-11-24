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


use arter\amos\core\helpers\Html;
use arter\amos\core\views\DataProviderView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use arter\amos\translation\AmosTranslation;
use arter\amos\translation\models\TranslationConf;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = AmosTranslation::t('amostranslation', 'Manage allowed translation of the user');
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate manager'), 'url' => ['/translation']];
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Manage translators'), 'url' => ['/translation/default/translators']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professional-profiles-index"> 
    <?php //echo $this->render('_filter', ['model' => $model]); ?>

    <p>
        <?php /* echo         Html::a('Nuovo Professional Profiles'        , ['create'], ['class' => 'btn btn-amministration-primary']) */ ?>
    </p>

    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="row">
        <div class="col-lg-6">
            <h2>User:</h2>
            <h3><?= $userProfile->one()->nome . ' ' . $userProfile->one()->cognome ?></h3>            
        </div>
        <div class="col-lg-6">
            <?php
            $lngs = TranslationConf::getStaticAllActiveLanguages()
                    ->orderBy('language_id');
            
            echo $form->field($model, 'language')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(
                                    $lngs->all(), 'language_id', 'name'), ['prompt' => AmosTranslation::t('amostranslation', 'Select allowed languages ...'), 'multiple' => true, 'size' => ($lngs->count() > 3) ? $lngs->count() + 1 : 3]
                    )->label('Allowed languages');
            ?>
        </div>    
    </div>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php
    ActiveForm::end();
    ?>
</div>
