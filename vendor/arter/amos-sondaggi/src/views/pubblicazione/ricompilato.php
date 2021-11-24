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
 * @package    arter\amos\sondaggi\views\pubblicazione
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\core\icons\AmosIcons;
use arter\amos\sondaggi\AmosSondaggi;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\sondaggi\models\search\SondaggiSearch $searchModel
 * @var \yii\db\ActiveQuery $pubblicazioni
 */
$this->title                   = AmosSondaggi::t('amossondaggi', '#sondaggioterminato');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sondaggi-index text-center sondaggi-success">
    <?php
    if (!empty($pubblicazioni->one()->text_end_title) && strlen(trim($pubblicazioni->one()->text_end_title))) {
        ?>
        <?=
        AmosIcons::show('check-circle', [
            'class' => 'am-4 success m-t-15'
        ])
        ?>
        <h2 class="p-t-5 nom-b"><?= $pubblicazioni->one()->text_end_title ?></h2>
        <?php
    } else {
        ?>
        <?=
        AmosIcons::show('check-circle', [
            'class' => 'am-4 success m-t-15'
        ])
        ?>
    <?php } ?>

    <?php
    if (!empty($pubblicazioni->one()->text_end) && strlen(trim($pubblicazioni->one()->text_end))) {
        if ($pubblicazioni->one()->text_end_html == 1) {
            ?>
            <?= $pubblicazioni->one()->text_end ?>
            <?php
        } else {
            ?>
            <h3><?= $pubblicazioni->one()->text_end ?></h3>
            <?php
        }
    } else {
        ?>
        <h3><?=
            AmosSondaggi::tHtml('amossondaggi', '#thankyoumessage').($pubblicazioni->one()->sondaggi->send_pdf_via_email
            == 1 ? 'Ti abbiamo inviato un’email di riepilogo con tutte le informazioni.' : '')
            ?></h3>
    <?php } ?>
    <?=
    Html::a(AmosSondaggi::t('amossondaggi', 'Chiudi'), !empty($url)?$url:Url::previous(),
        [
        'class' => 'btn btn-secondary undo-edit mr10'
    ]);
    ?>
</div>
