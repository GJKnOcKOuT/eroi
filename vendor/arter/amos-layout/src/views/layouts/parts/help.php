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
 * @package    arter\amos\core
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\FileHelper;

/* @var $this \yii\web\View */
?>
<?php
if (array_key_exists('help', $this->params) && isset($this->params['help']['filename'])) {
    echo '<div class="container-help container">';
    echo $this->renderPhpFile(FileHelper::localize($this->context->getViewPath() . DIRECTORY_SEPARATOR . 'help' . DIRECTORY_SEPARATOR . $this->params['help']['filename'] . '.php'));
    echo '</div>';

}

if (array_key_exists('intro', $this->params) && isset($this->params['intro']['filename'])) {
    echo '<div class="container-intro container">';
    echo $this->renderPhpFile(FileHelper::localize($this->context->getViewPath() . DIRECTORY_SEPARATOR . 'intro' . DIRECTORY_SEPARATOR . $this->params['intro']['filename'] . '.php'));
    echo '</div>';
}
?>