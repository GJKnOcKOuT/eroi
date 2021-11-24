<?php
echo "<?php\n";
?>

/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\db\Schema;

/**
* Class <?= $migrationName; ?>
*/
class <?= $migrationName; ?> extends \yii\db\Migration {

    public function safeUp() {
    <? foreach ($new_data as $k => $array_insert ): ?>
    $this->batchInsert(
            "<?= $table_name; ?>",
                [<? foreach ($array_insert['columns'] as $k=> $nome_campo ){?> '<?=$nome_campo;?>', <?}?> ],
                [[<? foreach ($array_insert['values'] as $k1 => $valore_campo_cond ){?> '<?=$valore_campo_cond;?>', <?}?>] ]
            );
        <? endforeach; ?>
    }

    public function safeDown() {
    <? foreach ($restore_data as $k => $array_delete ): ?>
        $this->delete(
            "<?= $table_name; ?>",
            [<? foreach ($array_delete['conditions'] as $nome_campo_cond => $valore_campo_cond ){?> "<?=$nome_campo_cond;?>" => "<?=$valore_campo_cond;?>", <?}?> ]
        );
    <? endforeach; ?>
    }
}