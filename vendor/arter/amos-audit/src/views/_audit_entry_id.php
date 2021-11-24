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


use arter\amos\audit\Audit;
use arter\amos\audit\components\Access;

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var arter\amos\audit\models\AuditEntry $entry */

if ($auditEntry = Audit::getInstance()->getEntry()) {
    if (!isset($style)) {
        $style = YII_DEBUG ? '' : 'color:transparent;';
    }
    if (Access::checkAccess()) {
        echo Html::a('audit-' . $auditEntry->id, ['/audit/entry/view', 'id' => $auditEntry->id], ['style' => $style]);
    } else {
        echo Html::tag('span', 'audit-' . $auditEntry->id, ['style' => $style]);
    }
}
