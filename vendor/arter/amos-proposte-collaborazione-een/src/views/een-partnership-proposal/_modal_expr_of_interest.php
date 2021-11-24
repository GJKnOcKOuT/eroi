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


use yii\bootstrap\Modal;
use arter\amos\een\AmosEen;
?>

<?php
$alert = AmosEen::t('amoseen',
        'Hai già richiesto informazioni per questa proposta di collaborazione. Attendi la risposta dello staff EEN');
Modal::begin([
    'id' => 'interestPopup-'.$model->id,
    'header' => '<b>'.AmosEen::t('amoseen', '#expr_of_interest').'</b>',
]);
?>
<?php if (false && \arter\amos\een\models\EenExprOfInterest::isNumExprOfInterestExceeded()) { ?>
    <div class="col-xs-12 nop m-b-15">
        <p><?= AmosEen::t('amoseen', '#limit_expr_of_interest_exceeded2') ?></p>
        <?php
        echo \yii\helpers\Html::a(AmosEen::t('amoseen', '#close'), ['#'],
            ['class' => "btn btn-secondary pull-right", 'data-dismiss' => "modal"]);
        ?>

    </div>
    <?php } else { ?>
    <div class="col-xs-12 nop m-b-15">
        <?php
        $link = \yii\helpers\Html::a(AmosEen::t('amoseen', 'clicca qui'),
                ['/een/een-expr-of-interest/create', 'idPartnershipProposal' => $model->id, 'request_more_info' => true],
                [
                'onclick' => $model->isRequestInfoSended() ? "alert('".$alert."'); return false;" : ''
        ]);
        ?>
        <p><?=
            AmosEen::t('amoseen',
                'Se vuoi conoscere i servizi gratuiti della Enterprise Europe Network, visita <a href="http://www.eensimpler.it/" target="_blank">http://www.eensimpler.it/</a> per Lombardia e Emilia-Romagna o <a href="http://www.een-italia.eu" target="_blank">http://www.een-italia.eu</a> per le altre regioni italiane).<br><br>

Se invece sei interessato a maggiori informazioni su questa proposta di collaborazione, premi il pulsante qui sotto.<br><br>')
            ?></p>
        <?=
        \arter\amos\core\helpers\Html::a(AmosEen::t('amoseen', '#get_in_touch_with_proponent'),
            ['/een/een-expr-of-interest/create', 'idPartnershipProposal' => $model->id],
            [
            'title' => AmosEen::t('amoseen', '#get_in_touch_with_proponent'),
            'class' => 'btn btn-navigation-primary pull-right  m-t-10'
        ]);
        ?>
    </div>
<?php } ?>


<?php
Modal::end();
