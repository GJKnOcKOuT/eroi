<form name="search" action="/search/search/do-search" data-pjax>
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
 echo \yii\helpers\Html::input("hidden", "queryString", $queryString); ?>
    <?php echo \yii\helpers\Html::input("hidden", "tagIds", $tagIds ); ?>
    <?php echo \yii\helpers\Html::input("hidden", "moduleName", $moduleName); ?>
    <?php echo \yii\helpers\Html::input("hidden", "tagValues", $moduleName, (!empty($tagValues) ? implode(',', $tagValues ): '')) ?>
</form>