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


use arter\amos\utility\Module;

$this->title = Module::t('amosutility', 'Run Migrations');
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>Migrations to be done:</h3>

<?php
if (!count($migrations)) {
    echo "None";
}
foreach ($migrations as $k => $migration) {
    echo "<p> - {$migration}</p>";
}
?>

<?php if ($force) : ?>
    <h3>Result:</h3>

    <p><?= $result; ?></p>
    <p><?= \yii\helpers\Html::a('Back', ['migrate'], ['class' => 'btn btn-default']) ?></p>
<?php else: ?>
    <br><br>
    <hr>
    <h4>Click here to run migrations, bon sorte!</h4>
    <p><?= \yii\helpers\Html::a('Migrate Now', ['migrate', 'force' => true], ['class' => 'btn btn-default']) ?></p>
<?php endif; ?>
