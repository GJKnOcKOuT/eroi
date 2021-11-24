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
 * @var $this \yii\web\View
 */

$cleaned = 0;

try {
    $cleaned = Yii::$app->controller->cleanAssetDirs();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    return $e->getCode();
}

?>
<center>Cleaned <?= (int) $cleaned; ?> Cache! <?= $cleaned ? 'Great!' : 'Sorry =('; ?></center>
<center style="color:#ff7a19;"><?= $cleaned ? 'Don\'t Be Afraid, May the cache has been recreated in the meantime, but the older has been cleaned anyway' : ''; ?></center>