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
use arter\amos\emailmanager\models\EmailSpool;
use arter\amos\emailmanager\assets\AmosMailAsset;
use arter\amos\core\icons\AmosIcons;
use yii\widgets\DetailView;

AmosMailAsset::register($this);

/* @var $this yii\web\View */
/* @var $model EmailSpool */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Email Spools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="email-spool-view">
    <div class="email-spool-view">
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
                            <dt><?= $model->getAttributeLabel('transport'); ?></dt>
                            <dd><?= $model->transport; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('template'); ?></dt>
                            <dd><?= $model->template; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('priority'); ?></dt>
                            <dd><?= $model->priority; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('status'); ?></dt>
                            <dd><?= $model->status; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('model_name'); ?></dt>
                            <dd><?= $model->model_name; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('model_id'); ?></dt>
                            <dd><?= $model->model_id; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('to_address'); ?></dt>
                            <dd><?= $model->to_address; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('from_address'); ?></dt>
                            <dd><?= $model->from_address; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('subject'); ?></dt>
                            <dd><?= $model->subject; ?></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('message'); ?></dt>
                            <dd class="mail_message_info"><p><?= $model->message; ?></p></dd>
                        </dl>
                        <dl>
                            <dt><?= $model->getAttributeLabel('sent date'); ?></dt>
                            <dd><?= date("d-M-Y H:i:s", $model->sent); ?></dd>
                        </dl>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
