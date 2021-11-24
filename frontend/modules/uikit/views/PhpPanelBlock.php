<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use app\modules\uikit\Uikit;

/**
 * @var $this
 * @var $data
 */

$id    = $data['id'];
if(!empty($data['class'][0])) {
    $class = $data['class'][0];
}
else {
    $class = '';
}

?>

<div id="<?php echo $id ?>" class="<?php echo $class ?>">
    <?= eval($data['content']); ?>
</div>