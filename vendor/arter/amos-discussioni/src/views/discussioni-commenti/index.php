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

use arter\amos\core\views\AmosGridView;
use arter\amos\core\utilities\ViewUtility;
use arter\amos\discussioni\AmosDiscussioni;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\discussioni\models\search\DiscussioniCommentiSearch $searchModel
 */

$this->title = AmosDiscussioni::t('amosdiscussioni', 'Discussioni Commenti');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discussioni-commenti-index">
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin();
echo AmosGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'testo:ntext',
        'discussioni_risposte_id',
        ['attribute' => 'created_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
        ['attribute' => 'updated_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
            
        ['class' => 'arter\amos\core\views\grid\ActionColumn',],
    ],
]);
Pjax::end(); ?>

</div>
