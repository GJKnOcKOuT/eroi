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
 * @package    arter\amos\een\views\een-partnership-proposal
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\views\toolbars\StatsToolbar;
use arter\amos\een\AmosEen;
use yii\bootstrap\Modal;
use arter\amos\core\forms\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\een\models\EenPartnershipProposal $model
 */

?>
<?php
$currentUrl = explode("?", \yii\helpers\Url::current());
$isArchived = false;
if($currentUrl[0] == '/een/een-partnership-proposal/archived') {
    $isArchived = true;
}
?>
<div class="listview-container proposte-een-item nop">
    <div class="post">
        <div class="post-content col-xs-12 nop">
            <div class="post-title col-xs-12">
                <?= Html::a(Html::tag('h2', $model->content_title), [
                    'view',
                    'id' => $model->id
                ]) ?>
            </div>
            <div class="col-xs-12 m-b-10 nop">
                <i><?= AmosEen::t('amoseen','Identificativo proposta: ').$model->reference_external ?></i>
<!--                --><?php //if($model->isExprOfInterestSended()) {
//                    echo Html::a(AmosEen::t('amoseen', '#request_sended'), '/een/een-expr-of-interest', ['class' => 'pull-right']);
//                }?>
<!--                --><?php //if(!$model->isExprOfInterestSended() && !$isArchived) { ?>
<!--                    <a class= 'btn btn-navigation-primary pull-right' href="#--><?php //echo'interestPopup-'.$model->id?><!--" -->
<!--                       id="--><?php //echo $model->id?><!--" -->
<!--                       title="--><?php //echo AmosEen::t('amoseen', '#expr_of_interest_request_more_info') ?><!--"-->
<!--                       data-target="#interestPopup---><?php //echo $model->id?><!--" -->
<!--                       data-toggle="modal">--><?php //echo AmosEen::t('amoseen', '#expr_of_interest_request_more_info') ?><!--</a>-->
<!--                --><?php //} ?>
            </div>
            <div class="clearfix"></div>
            <div class="row nom post-wrap">
                <?php
                if(false){
                    $url = '/img/img_default.jpg';
                    if (!is_null($model->attachments)) {
                        $url = $model->attachments[0]->getUrl('original');
                    }
                    ?>
                    <div class="post-image-right">
                        <?= Html::img($url, ['class' => '']) ?>
                    </div>
                    <?php
                } ?>
                <div class="post-text">
                    <p>
                        <?php
                        if (strlen($model->content_summary) > 800):
                            $stringCut = substr($model->content_summary, 0, 800);
                            echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                        else:
                            echo $model->content_summary;
                        endif;
                        ?>
                        <br>
                        <a class="underline" href="<?= Yii::$app->getUrlManager()->createUrl([
                            '/een/een-partnership-proposal/view',
                            'id' => $model->id
                        ]) ?>"
                           title="<?= AmosEen::t('amoseen', 'Leggi tutto') ?>"><?= AmosEen::tHtml('amoseen', 'Leggi tutto') ?></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="post-footer col-xs-12 nop">
            <div class="post-info col-xs-6">
                <span class="bold"><?= $model->getAttributeLabel('reference_external') ?>:</span>
                <span><?= $model->reference_external ?></span>
                <br>
                <span class="bold"><?= $model->getAttributeLabel('reference_type') ?>:</span>
                <span><?= $model->getReferenceTypeLabel() ?></span>
                <br>
                <span class="bold"><?= $model->getAttributeLabel('company_country_label') ?>:</span>
                <span><?= $model->company_country_label ?></span>
                <br>
            </div>
            <div class="post-info col-xs-6">
                <span class="bold"><?= $model->getAttributeLabel('datum_submit') ?>:</span>
                <span><?= Yii::$app->getFormatter()->asDate($model->datum_submit) ?></span>
                <br>
                <span class="bold"><?= $model->getAttributeLabel('datum_update') ?>:</span>
                <span><?= Yii::$app->getFormatter()->asDate($model->datum_update) ?></span>
                <br>
                <span class="bold"><?= $model->getAttributeLabel('datum_deadline') ?>:</span>
                <span><?= Yii::$app->getFormatter()->asDate($model->datum_deadline) ?></span>
            </div>
            <?= StatsToolbar::widget([
                'model' => $model,
            ]);
            ?>
            <p>
                <?php echo $this->render('_modal_expr_of_interest', ['model' => $model]);?>
            </p>
        </div>
    </div>
</div>
