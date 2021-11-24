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
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $panel yii\debug\panels\UserPanel */

$encodedName = Html::encode($panel->getName());
?>

<h1><?= $encodedName ?></h1>

<?php
if (isset($panel->data['identity'])) {
    $name = 
    $items = [
        'nav' => [$encodedName],
        'content' => [
            "<h2>{$encodedName} Info</h2>" . DetailView::widget([
                'model' => $panel->data['identity'],
                'attributes' => $panel->data['attributes']
            ])
        ]
    ];
    if ($panel->data['rolesProvider'] || $panel->data['permissionsProvider']) {
        $items['nav'][] = 'Roles and Permissions';
        $items['content'][] = $this->render('roles', ['panel' => $panel]);
    }

    if ($panel->canSwitchUser()) {
        $items['nav'][] = "Switch {$encodedName}";
        $items['content'][] = $this->render('switch', ['panel' => $panel]);
    }

    ?>
    <ul class="nav nav-tabs">
        <?php
        foreach ($items['nav'] as $k => $item) {
            echo Html::tag(
                'li',
                Html::a($item, '#u-tab-' . $k, [
                    'class' => $k === 0 ? 'nav-link active' : 'nav-link',
                    'data-toggle' => 'tab',
                    'role' => 'tab',
                    'aria-controls' => 'u-tab-' . $k,
                    'aria-selected' => $k === 0 ? 'true' : 'false'
                ]),
                [
                    'class' => 'nav-item'
                ]
            );
        }
        ?>
    </ul>
    <div class="tab-content">
        <?php
        foreach ($items['content'] as $k => $item) {
            echo Html::tag('div', $item, [
                'class' => $k === 0 ? 'tab-pane fade active show' : 'tab-pane fade',
                'id' => 'u-tab-' . $k
            ]);
        }
        ?>
    </div>
    <?php

} else {
    echo 'Is guest.';
} ?>
