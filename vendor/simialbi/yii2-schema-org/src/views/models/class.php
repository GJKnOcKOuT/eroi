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


/** @var $this \yii\web\View */
/** @var $description string */
/** @var $className string */
/** @var $label string */
/** @var $properties array */
/** @var $namespace string */

echo '<?php' . "\n";
?>

namespace <?= $namespace ?>;

use simialbi\yii2\schemaorg\models\Model;

/**
<?php foreach (explode("\n", $description) as $chunk) : ?>
 * <?= wordwrap($chunk, 75, "\n * ") . "\n" ?>
<?php endforeach ?>
 *
 * @see http://schema.org/<?= $label . "\n" ?>
 */
class <?= $className ?> extends Model
{
<?php foreach ($properties as $property) : ?>
    /**
<?php foreach (explode("\n", $property['description']) as $chunk) : ?>
     * <?= wordwrap($chunk, 75, "\n     * ") . "\n" ?>
<?php endforeach ?>
     *
     * @var <?= implode('|', $property['types']) . "\n" ?>
     * @see <?= $property['see'] . "\n" ?>
     */
    public $<?= $property['name'] ?>;

<?php endforeach ?>
}
