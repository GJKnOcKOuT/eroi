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
use yii\widgets\ActiveForm;

use yii\web\View;

/**
 * @var yii\web\View $this
 * @var \arter\amos\attachments\models\search\FileSearch $model
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var string $currentView
 */
?>
<div class="event-index">

    <?php $form = ActiveForm::begin(
        [
            'action' => \Yii::$app->controller->action->id,
            'method' => 'post',
        ]
    );
    ?>

    <div class="col-md-12">
        <label><?= Yii::t('app', 'Query')?></label>
        <?= Html::textarea('query', '', ['class'=> 'form-control', 'width' => "100%",'rows' => 20]); ?>
    </div>
    <div>
        <?= Html::submitButton('Conferma', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
