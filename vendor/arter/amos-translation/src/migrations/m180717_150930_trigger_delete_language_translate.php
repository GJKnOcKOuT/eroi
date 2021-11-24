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
 * @package    arter\amos\translation\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * Class m180717_150930_trigger_delete_language_translate
 */
class m180717_150930_trigger_delete_language_translate extends \yii\db\Migration
{
    const TABLE = '{{%translation_conf}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->execute("
        CREATE TRIGGER delete_preferences_language AFTER DELETE ON language_translate
        FOR EACH ROW
        DELETE FROM `language_translate_user_fields`
        WHERE language_translate_user_fields.language_translate_id = OLD.id
            AND language_translate_user_fields.language_translate_language = OLD.language");
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute("DROP TRIGGER delete_preferences_language");
    }
}
