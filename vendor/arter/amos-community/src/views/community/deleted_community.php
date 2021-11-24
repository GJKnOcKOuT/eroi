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
 * @package    arter\amos\community\views\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;

/**
 * @var yii\web\View $this
 * @var \arter\amos\community\models\Community $model
 * @var string $tabActive
 */

$this->title = AmosCommunity::t('amoscommunity', '#deleted_community_title');
$this->params['breadcrumbs'][] = ['label' => AmosCommunity::t('amoscommunity', 'Community'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="community-view">
    <div class="col-xs-12">
        <h2><?= AmosCommunity::t('amoscommunity', '#deleted_community_text'); ?></h2>
    </div>
    <div class="clearfix"></div>
</div>
