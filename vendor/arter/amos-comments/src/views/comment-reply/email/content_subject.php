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
 * @package    arter\amos\comments\views\comment\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\comments\AmosComments;
use arter\amos\core\interfaces\BaseContentModelInterface;
use arter\amos\core\interfaces\ModelLabelsInterface;

/**
 * @var \arter\amos\core\record\Record $contextModel
 */

$title = $contextModel->__toString();
if (($contextModel instanceof BaseContentModelInterface) || $contextModel->hasMethod('getTitle')) {
    $title = $contextModel->getTitle();
}

$label = '-';
if (($contextModel instanceof ModelLabelsInterface) || $contextModel->hasMethod('getGrammar')) {
    $label = $contextModel->getGrammar()->getModelSingularLabel();
}

?>

<?= AmosComments::t('amoscomments', '#notification_email_subject', [$label, $title]); ?>
