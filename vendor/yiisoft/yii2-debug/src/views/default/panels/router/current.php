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

/* @var $currentRoute yii\debug\models\router\CurrentRoute */
?>
<h3>
    <?= Yii::$app->i18n->format(
        '{rulesTested, plural, =0{} =1{Tested # rule} other{Tested # rules}}{hasMatch, plural, =0{} other{ before match}}.',
        [
            'rulesTested' => $currentRoute->count,
            'hasMatch' => (int)$currentRoute->hasMatch,
        ],
        'en_US'
    ); ?>
</h3>

<?php if ($currentRoute->message !== null): ?>
    <div class="alert alert-info">
        <?= Html::encode($currentRoute->message) ?>
    </div>
<?php endif; ?>
<?php if (count($currentRoute->logs)): ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Rule</th>
                <th>Parent</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($currentRoute->logs as $i => $log): ?>
                <tr<?= $log['match'] ? ' class="table-success"' : '' ?>>
                    <td><?= $i + 1; ?></td>
                    <td><?= Html::encode($log['rule']) ?></td>
                    <td><?= Html::encode($log['parent']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif;
