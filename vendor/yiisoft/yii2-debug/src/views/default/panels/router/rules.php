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

/* @var $routerRules \yii\debug\models\router\RouterRules */
?>
<?php if (count($routerRules->rules) === 0): ?>
    <h3>No routing rules configured.</h3>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Rule</th>
                <th>Target</th>
                <th>Verb</th>
                <th>Suffix</th>
                <th>Mode</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($routerRules->rules as $i => $rule): ?>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <td><?= Html::encode($rule['name']); ?></td>
                        <td><?= Html::encode($rule['route']); ?></td>
                        <td><?= is_array($rule['verb']) ? implode(', ', array_map(function ($element) {
                                return Html::encode($element);
                            }, $rule['verb'])) : null ?></td>
                        <td><?= Html::encode($rule['suffix']); ?></td>
                        <td><?= Html::encode($rule['mode']); ?></td>
                        <td><?= $rule['type'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif;
