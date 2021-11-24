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
    <? foreach ($new_data as $k => $array_update ): ?>
    $this->update(
            "<?= $table_name; ?>",
                [<? foreach ($array_update['columns'] as $nome_campo => $valore_campo ){?> "<?=$nome_campo;?>" => "<?=$valore_campo;?>", <?}?> ],
                [<? foreach ($array_update['conditions'] as $nome_campo_cond => $valore_campo_cond ){?> "<?=$nome_campo_cond;?>" => "<?=$valore_campo_cond;?>", <?}?> ]
            );
        <? endforeach; ?>
    }

    public function safeDown() {
    <? foreach ($restore_data as $k => $array_restore ): ?>
        $this->update(
            "<?= $table_name; ?>",
            [<? foreach ($array_restore['columns'] as $nome_campo => $valore_campo ){?> "<?=$nome_campo;?>" => "<?=$valore_campo;?>", <?}?> ],
            [<? foreach ($array_restore['conditions'] as $nome_campo_cond => $valore_campo_cond ){?> "<?=$nome_campo_cond;?>" => "<?=$valore_campo_cond;?>", <?}?> ]
        );
    <? endforeach; ?>
    }
}