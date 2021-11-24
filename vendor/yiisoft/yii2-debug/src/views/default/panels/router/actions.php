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

/* @var $actionRoutes yii\debug\models\router\ActionRoutes */
?>
<?php if (count($actionRoutes->routes) === 0): ?>
    <h3>No actions configured.</h3>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Action</th>
                <th>Route</th>
                <th>First Matching Rule</th>
                <th>Rules Tested</th>
            </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($actionRoutes->routes as $action => $route): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $action; ?></td>
                        <td><?= Html::encode($route['route']) ?></td>
                        <td><?= Html::encode($route['rule']) ?></td>
                        <td><?= Html::encode($route['count']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif;
