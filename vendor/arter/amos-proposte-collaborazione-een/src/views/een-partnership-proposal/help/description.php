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

$profile = \arter\amos\admin\models\UserProfile::find()->andWhere(['user_id' => \Yii::$app->user->id])->one();
$link    = "/admin/user-profile/update?id=".$profile->id.'#w44-tab5';

$tags = \arter\amos\tag\models\Tag::find()
    ->innerJoin('cwh_tag_owner_interest_mm', 'tag.id = cwh_tag_owner_interest_mm.tag_id')
    ->andWhere(['cwh_tag_owner_interest_mm.record_id' => $profile->id])
    ->andWhere(['cwh_tag_owner_interest_mm.classname' => 'arter\amos\admin\models\UserProfile'])
    ->andWhere(['cwh_tag_owner_interest_mm.interest_classname' => 'simple-choice'])
    ->andWhere(['root' => 3])
    //->andWhere(['lvl' => 3])
    ->andWhere(['cwh_tag_owner_interest_mm.deleted_at' => null])
    ->groupBy('tag.id')
    ->limit(10);

$arayTag = '';
foreach ($tags->all() as $tag) {
    $arayTag .= '<div class="tags-list-single m-r-15 pull-left" data-tag="2006">
        <p><span class="am am-label"> </span> <em><span></sp>'.$tag->nome.'</span></em> </p>
    </div>';
}
?>

<?php
if (!strcmp(Yii::$app->controller->action->id, 'own-interest')) { /* ?>
  <p><?=
  \arter\amos\een\AmosEen::t('amoseen',
  'Consulta o ricerca le proposte di collaborazione internazionali promosse da <a href="http://een.ec.europa.eu">Enterprise Europe Network</a> selezionate sulla base degli interessi che hai indicato nel tuo profilo:',
  ['link_profilo' => $link])
  ?></p>
  <div class="col-xs-12"><?= $arayTag ?></div>
  <p><?=
  \arter\amos\een\AmosEen::t('amoseen',
  "Segui <a href='{link_profilo}'>questo link</a> se desideri modificarli o per cambiare la periodicità con cui ricevi le notifiche. Per pubblicare una proposta di collaborazione fai clic su «crea una proposta»",
  ['link_profilo' => $link])
  ?></p>


  <?php */
} else if (Yii::$app->controller->action->id == 'index') {
    $modelSearch  = new \arter\amos\een\models\search\EenPartnershipProposalSearch();
    /** @var  $dataProvider \yii\data\ActiveDataProvider */
    $dataProvider = $modelSearch->searchAll([]);

    $n = $dataProvider->getTotalCount();
    ?>
    <style>.page-header .title+.text-help-layout a {
            color: #337ab7;
        }
    </style>
    <div class="alert alert-info" role="alert"><p><?=
            \arter\amos\een\AmosEen::t('amoseen',
                "Naviga fra le {n} proposte di collaborazione internazionali promosse da <a href=\"http://een.ec.europa.eu\" target=\"_blank\" >Enterprise Europe Network</a>, la più grande Rete finanziata dalla Commissione Europea per il supporto all'innovazione, all'internazionalizzazione e alla competitività delle imprese.
    <br><br> Per personalizzare le tue Aree di interesse e la frequenza delle notifiche sulle proposte di collaborazione internazionali Enterprise Europe Network vai alla <strong><a href=\"/ticket/assistenza/cerca-faq\" target=\"_blank\" >pagina FAQ</a></strong>.
    <br><br> Per pubblicare una proposta di collaborazione tecnologia, fai clic su «Crea una proposta» e scopri come procedere.",
                ['link_profilo' => $link, 'n' => $n])
            ?></p></div>

<?php } ?>
