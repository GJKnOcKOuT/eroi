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


/** @var View $this */
/** @var AuditMail $model */

use arter\amos\audit\models\AuditMail;

use yii\web\View;
use yii\helpers\Html;

$this->title = Yii::t('audit', 'Mail #{id}', ['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Audit'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Mails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '#' . $model->id;

//echo Yii::$app->formatter->asHtml($model->html);

if (class_exists('\PhpMimeMailParser\Parser')) {
    $parser = new \PhpMimeMailParser\Parser\Parser();
    $parser->setText($model->data);
    echo $parser->getMessageBody('htmlEmbedded');
} else {
    echo Html::tag('pre', $model->data) . Html::tag('br') . 'Please install php-mime-mail-parser for better functionality';
}
