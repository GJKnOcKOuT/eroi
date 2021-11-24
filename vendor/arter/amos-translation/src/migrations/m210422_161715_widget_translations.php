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

use yii\db\Migration;

/**
 * Class m181108_161715_regroup_widgets_translation
 */
class m210422_161715_widget_translations extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update('amos_widgets', ['child_of' => null ], ['classname' => 'arter\amos\translation\widgets\icons\WidgetIconTranslation']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update('amos_widgets', ['child_of' => 'arter\amos\dashboard\widgets\icons\WidgetIconManagement' ], ['classname' => 'arter\amos\translation\widgets\icons\WidgetIconTranslation']);
    }
}
