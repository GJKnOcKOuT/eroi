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

/** @var  $sondaggio \arter\amos\sondaggi\models\Sondaggi */

$header = $data[0];
$risposte = $data[1];
$i = 1;
?>
<h2><?= $sondaggio->titolo ?></h2>
<br>

<?php foreach ($risposte as $key => $risposta){ ?>
    <label><strong><?= $header[$key]?></strong></label>
    <p><?= $risposta?></p>
    <?php if ($key == 2) {
        echo "<label><strong>Iniziato il</strong>";
        echo "<p>". (!empty($rispostaModel->begin_date) ? \Yii::$app->formatter->asDate($rispostaModel->begin_date) : '')."</p>";
        echo "<label><strong>Completato il</strong>";
        echo "<p>". (!empty($rispostaModel->end_date) ? \Yii::$app->formatter->asDate($rispostaModel->end_date) : '')."</p>";
        echo "<hr>";
    } ?>
<?php } ?>