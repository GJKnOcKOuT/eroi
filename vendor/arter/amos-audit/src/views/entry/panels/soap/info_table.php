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


use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;

if (isset($request['error']) && isset($request['error'][1])) {
    $error = \arter\amos\audit\models\AuditError::findOne($request['error'][1]);
    $request['error'] = Html::a('[' . $request['error'][0] . '] ' . $error->message, ['error/view', 'id' => $error->id]);
}
?>
<div class="table-responsive">
    <table class="table table-condensed table-bordered table-striped table-hover request-table" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($request as $name => $value): ?>
            <tr>
                <th><?= Html::encode(\yii\helpers\Inflector::humanize($name)) ?></th>
                <td>
<?php
    if (is_array($value) || is_object($value))
        $value = \yii\helpers\ArrayHelper::toArray($value);
    elseif ($name == 'duration')
        $value = number_format($value, 2) . 's';
    echo $name == 'error' ? $value : $formatter->asText(is_scalar($value) ? $value : VarDumper::dumpAsString($value));
?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
