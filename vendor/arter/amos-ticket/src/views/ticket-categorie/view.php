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
 * @package    arter\amos\ticket\views\ticket-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\ticket\AmosTicket;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\TicketCategorie $model
 */

$this->title = $model->titolo;
$this->params['breadcrumbs'][] = ['label' => AmosTicket::t('amosticket', 'Assistenza'), 'url' => '/ticket'];
$this->params['breadcrumbs'][] = ['label' => AmosTicket::t('amosticket', 'Categorie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="news-categorie-view">
    <div class="row">
        <div class="col-xs-12">
            <div class="body">
                <section class="section-data">
                    <?= ContextMenuWidget::widget([
                        'model' => $model,
                        'actionModify' => "/ticket/ticket-categorie/update?id=" . $model->id,
                        'actionDelete' => "/ticket/ticket-categorie/delete?id=" . $model->id,
                        'labelDeleteConfirm' => AmosTicket::t('amosticket', 'Sei sicuro di voler cancellare questa categoria?'),
                    ]) ?>
                    <h2>
                        <?php /*<?= AmosIcons::show('rss'); */ ?>
                        <?= AmosTicket::t('amosticket', 'Dettagli'); ?>
                    </h2>
                    <dl>
                        <dt><?= $model->getAttributeLabel('categoryIcon'); ?></dt>
                        <dd><?= Html::img($model->getCategoryIconUrl(), ['class' => 'gridview-image']) ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('titolo'); ?></dt>
                        <dd><?= $model->titolo; ?></dd>
                    </dl>
                    <?php /* 
                    <dl>
                        <dt><?= $model->getAttributeLabel('sottotitolo'); ?></dt>
                        <dd><?= $model->sottotitolo; ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('descrizione_breve'); ?></dt>
                        <dd><?= $model->descrizione_breve; ?></dd>
                    </dl>
                     */ ?>

                    <dl>
                        <dt><?= $model->getAttributeLabel('descrizione'); ?></dt>
                        <dd><?= $model->descrizione; ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('categoria_padre_id'); ?></dt>
                        <dd><?= ($model->categoria_padre_id) ? $model->categoriaPadre->nomeCompleto : "" ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('attiva'); ?></dt>
                        <dd><?= ($model->attiva) ? AmosTicket::t('amosticket', 'Si') : AmosTicket::t('amosticket', 'No') ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('abilita_ticket'); ?></dt>
                        <dd><?= ($model->abilita_ticket) ? AmosTicket::t('amosticket', 'Si') : AmosTicket::t('amosticket', 'No') ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('tecnica'); ?></dt>
                        <dd><?= ($model->tecnica) ? AmosTicket::t('amosticket', 'Si') : AmosTicket::t('amosticket', 'No') ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('email_tecnica'); ?></dt>
                        <dd><?= $model->email_tecnica; ?></dd>
                    </dl>
                    <dl>
                        <dt><?= AmosTicket::t('amosticket', 'Referenti di questa categoria') ?></dt>
                        <dd>
                            <?php $referents = "";
                            foreach ($model->ticketCategorieUsersMms as $user) {
                                $referents .= $user->userProfile . "<br>";
                            } ?>
                            <?= $referents ?>
                        </dd>
                    </dl>
                </section>
            </div>
        </div>
    </div>
    <div class="btnViewContainer pull-right">
        <?= Html::a(Yii::t('amoscore', 'Chiudi'), Url::previous(), ['class' => 'btn btn-secondary']); ?>
    </div>
</div>
