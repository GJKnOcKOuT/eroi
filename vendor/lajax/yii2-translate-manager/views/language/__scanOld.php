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

/**
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.4
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $oldDataProvider \yii\data\ArrayDataProvider */

?>
<?php if ($oldDataProvider->totalCount > 1) : ?>

    <?= Html::button(Yii::t('language', 'Select all'), ['id' => 'select-all', 'class' => 'btn btn-primary']) ?>

    <?= Html::button(Yii::t('language', 'Delete selected'), ['id' => 'delete-selected', 'class' => 'btn btn-danger']) ?>

<?php endif ?>

<?php if ($oldDataProvider->totalCount > 0) : ?>

    <?=

    GridView::widget([
        'id' => 'delete-source',
        'dataProvider' => $oldDataProvider,
        'columns' => [
            [
                'format' => 'raw',
                'attribute' => '#',
                'content' => function ($languageSource) {
                    return Html::checkbox('LanguageSource[]', false, ['value' => $languageSource['id'], 'class' => 'language-source-cb']);
                },
            ],
            'id',
            'category',
            'message',
            'languages',
            [
                'format' => 'raw',
                'attribute' => Yii::t('language', 'Action'),
                'content' => function ($languageSource) {
                    return Html::a(Yii::t('language', 'Delete'), Url::toRoute('/translatemanager/language/delete-source'), ['data-id' => $languageSource['id'], 'class' => 'delete-item btn btn-xs btn-danger']);
                },
            ],
        ],
    ]);

    ?>

<?php endif ?>