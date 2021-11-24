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

/* @var $panel arter\amos\audit\panels\SoapPanel */

use arter\amos\audit\components\Helper;

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

$preformatted = ['class' => 'well', 'style' => 'overflow: auto; white-space: pre'];
$formatter = \Yii::$app->formatter;

$tabs = [];

if (isset($request['result_object'])) {
    $tabs[] = [
        'label' => \Yii::t('audit', 'Result - Object'),
        'content' => Html::tag('div', $formatter->asText(VarDumper::dumpAsString(ArrayHelper::toArray($request['result_object']))), $preformatted)
    ];

    unset($request['result_object']);
}

if (isset($request['result'])) {
    $xml = Helper::formatAsXML($request['result']);
    if ($xml)
        $tabs[] = [
            'label' => \Yii::t('audit', 'Result - XML'),
            'content' => Html::tag('div', $xml, $preformatted)
        ];

    $tabs[] = [
        'label' => \Yii::t('audit', 'Result'),
        'content' => Html::tag('div', $formatter->asText($request['result']), $preformatted)
    ];

    unset($request['result']);
}

$tabs[] = [ 'label' => \Yii::t('audit', 'Info'), 'content' => $this->render('info_table', ['request' => $request]), 'active' => true ];

echo Html::tag('h2', \Yii::t('audit', 'Request #{id}', ['id' => $index])), Tabs::widget(['items' => array_reverse($tabs)]);
