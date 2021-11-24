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

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;
use arter\amos\sondaggi\models\SondaggiDomandePagine;
use arter\amos\sondaggi\models\SondaggiDomandeTipologie;
use arter\amos\sondaggi\models\SondaggiDomandeCondizionate;
use arter\amos\sondaggi\models\SondaggiRispostePredefinite;
use arter\amos\sondaggi\models\Sondaggi;
use arter\amos\sondaggi\models\SondaggiDomande;
use arter\amos\sondaggi\models\SondaggiRisposte;
use arter\amos\sondaggi\models\SondaggiRisposteSessioni;
use arter\amos\sondaggi\models\SondaggiStato;
use arter\amos\sondaggi\AmosSondaggi;
use yii\web\UploadedFile;
use arter\amos\attachments\models\File;



/**
* Questa è la classe base per la pagina "<?= $generator->paginaSondaggio ?>" del sondaggio "<?= $generator->titoloSondaggio ?>".
*
<?php /* foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
  <?php endforeach; */ ?>

*/
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{

<?php foreach ($attributi as $attributo): ?>
    <?= $attributo . ";\n" ?>
<?php endforeach; ?>

/**
* @inheritdoc
*/
public function rules()
{
return [<?= "\n " . implode(",\n ", $rules) . "\n        " ?>];
}


/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
<?php foreach ($labels as $name): ?>
    <?= $name . ",\n" ?>
<?php endforeach; ?>
];
}
<?php foreach ($funzioni as $funzione): ?>
    <?= "\n" . $funzione . "\n" ?>
<?php endforeach; ?>

/**
* Salva le risposte del sondaggio relativamente a questa pagina
* @param integer $sessione Id della sessione a cui è collegata la compilazione del sondaggio
* @param integer $accesso Id dell'accesso al servizio di facilitazione se il sondaggio è stato compilato in quell'occasione
* @param integer $completato 0 | 1 di default a 0 se non specificato e indica se la pagina che si sta salvando è l'ultima o meno
*/
public function save($sessione, $accesso = NULL, $completato = false) {
<?php foreach ($salvataggio as $Save): ?>
    <?= "\n" . $Save . "\n" ?>
<?php endforeach; ?>
}
}
<?php echo "\n?>"; ?>
