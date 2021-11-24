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
use arter\amos\utility\Module;

/* @var $this \yii\web\View */

$this->title = Module::t('amosutility', 'File Manager');

$src = Yii::getAlias('@vendor/arter/amos-utility/src');

define('FM_EMBED', true);
define('FM_ROOT_PATH', Yii::getAlias('@app').'/..');
define('FM_SELF_URL', '/' . Yii::$app->controller->getRoute());

require $src . '/libs/tinyfilemanager.php';