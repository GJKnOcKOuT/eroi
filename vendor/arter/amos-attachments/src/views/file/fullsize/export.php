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
 * @package    arter\amos\events\views\event
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\utilities\ModalUtility;
use arter\amos\core\views\DataProviderView;
use arter\amos\events\AmosEvents;

use yii\web\View;

/**
 * @var yii\web\View $this
 * @var \arter\amos\attachments\models\search\FileSearch $model
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var string $currentView
 */
?>
<?= $this->render('_search', ['model' => $model]); ?>
<div class="event-index">
    <?= \kartik\grid\GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'name',
                'model',
                'attribute',
                'creator' => [
                    'label' => 'Creatore',
                    'value' => function ($model) {
                        if ($model->owner->id) {
                            $userProfile = \arter\amos\admin\models\UserProfile::findOne($model->owner->created_by);

                            return $userProfile->getNomeCognome();
                        } else {
                            return '?';
                        }
                    }
                ],
                'hash',
                'type',
            ]
        ]
    ); ?>
</div>
