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
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\icons\AmosIcons;


echo $this->render('_search_external_facilitator', ['model' => $model]);

echo \arter\amos\core\views\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@vendor/arter/amos-admin/src/views/user-profile/_item'
]);
