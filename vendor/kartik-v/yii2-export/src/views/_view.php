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
 * @package   yii2-export
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2018
 * @version   1.3.9
 *
 * Export Submission View
 *
 */

use yii\helpers\Html;

/**
 * @var bool $isBs4
 * @var string $icon
 * @var string $file
 * @var string $href
 */
$badgePrefix = $isBs4 ? 'badge badge-' : 'label label-';
?>
<div class="alert alert-success alert-dismissible" role="alert" style="margin:10px 0">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong><?= Yii::t('kvexport', 'Exported File') ?>: </strong>
    <span class="h5" data-toggle="tooltip" title="<?= Yii::t('kvexport', 'Download exported file') ?>">
        <?= Html::a("<i class='{$icon}'></i> {$file}", $href, ['class' => $badgePrefix . 'success']) ?>
    </span>
</div>