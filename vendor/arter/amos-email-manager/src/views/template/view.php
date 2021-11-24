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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\emailmanager\AmosEmail;
use arter\amos\emailmanager\models\EmailTemplate;
use arter\amos\emailmanager\assets\AmosMailAsset;
use arter\amos\core\icons\AmosIcons;
use yii\widgets\DetailView;

AmosMailAsset::register($this);

/* @var $this yii\web\View */
/* @var $model EmailTemplate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => AmosEmail::t('amosemail', 'Email Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-view">
    <div class="corsi-view col-xs-12 nop">
        <div class="row">
            <div class="col-xs-12">
                <section class="section-data">
                    <h2>
                        <?= AmosIcons::show('book'); ?>
                        Informazioni
                    </h2>
                    <dl>
                        <dt><?= $model->getAttributeLabel('id'); ?></dt>
                        <dd><?= $model->id; ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('name'); ?></dt>
                        <dd><?= $model->name; ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('subject'); ?></dt>
                        <dd><?= $model->subject; ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('heading'); ?></dt>
                        <dd><?= $model->heading; ?></dd>
                    </dl>
                    <dl>
                        <dt><?= $model->getAttributeLabel('Message'); ?></dt>
                        <dd class="mail_message_info"><?= $model->message; ?></dd>
                    </dl>
                </section>
            </div>
        </div>
    </div>
    <div class="btnViewContainer pull-right">
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </div>

