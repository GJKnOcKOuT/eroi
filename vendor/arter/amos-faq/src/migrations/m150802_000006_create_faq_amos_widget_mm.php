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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

class m150802_000006_create_faq_amos_widget_mm extends \yii\db\Migration
{
    private $tabella = null;

    public function __construct()
    {
        $this->tabella = '{{%faq_amos_widgets_mm}}';
        parent::__construct();
    }

    public function up()
    {
        if ($this->db->schema->getTableSchema($this->tabella, true) === null) {
            $this->createTable($this->tabella, [
                'faq_id' => $this->integer(11)->notNull()->comment('FAQ ID'),
                'amos_widgets_classname' => $this->string(255)->notNull()->comment('Widget classname ID'),
                'created_at' => $this->dateTime()->defaultValue(null)->comment('Creato il'),
                'updated_at' => $this->dateTime()->defaultValue(null)->comment('Aggiornato il'),
                'deleted_at' => $this->dateTime()->defaultValue(null)->comment('Cancellato il'),
                'created_by' => $this->integer(11)->defaultValue(null)->comment('Creato da'),
                'updated_by' => $this->integer(11)->defaultValue(null)->comment('Aggiornato da'),
                'deleted_by' => $this->integer(11)->defaultValue(null)->comment('Cancellato da'),
            ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);
            $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
            $this->addPrimaryKey('pk_faq_amos_widgets_mm', $this->tabella, 'faq_id, amos_widgets_classname');
//            $this->addForeignKey('fk_faq_amos_widgets_mm_amos_widgets1_idx', $this->tabella, 'amos_widgets_classname', 'amos_widgets', 'classname');
            $this->addForeignKey('fk_faq_amos_widgets_mm_faq1_idx', $this->tabella, 'faq_id', 'faq', 'id');
            $this->execute("SET FOREIGN_KEY_CHECKS = 1;");

        } else {
            echo "Nessuna creazione eseguita in quanto la tabella esiste gia'";
            return true;
        }
    }

    public function down()
    {
        $this->dropTable($this->tabella);
        return true;
    }
}
