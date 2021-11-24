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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\discussioni\AmosDiscussioni;

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniTopic $model
 */

/** @var \arter\amos\discussioni\controllers\DiscussioniTopicController $controller */
$controller = Yii::$app->controller;
$controller->setNetworkDashboardBreadcrumb();
$this->title = AmosDiscussioni::t('amosdiscussioni', 'Nuova {modelClass}', ['modelClass' => 'Discussione',]);
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discussioni-topic-create">
<?=
$this->render(
    '_form',
    [
        'model' => $model,
    ]
)
?>
</div>
