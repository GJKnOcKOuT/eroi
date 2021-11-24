<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 */

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

function pr($var, $info = '') {
    if(!defined('PR')) {
      define('PR', true);
    }
    if ($info) {
        $info = "<strong>$info: </strong>";
    }
    $debug = debug_backtrace(0);
    $result = "<pre style='font-size:11px;text-align:left;background:#fff;color:#000;'><strong>".$debug[0]['file'] ." ".$debug[0]['line']."</strong><br /> $info";
    $dump = print_r($var, true);
    $dump = highlight_string("<?php\n" . $dump, true);
    $dump = preg_replace('/&lt;\\?php<br \\/>/', '', $dump, 1);
    $result .= "$dump</pre>";

    echo $result;
}
