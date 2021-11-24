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
 * @package    arter\amos\ticket
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m190225_163132_insert_documents_explorer_widget_in_community
 */
class m190225_163132_insert_documents_explorer_widget_in_community extends \arter\amos\core\migration\AmosMigration
{
    const MODULE_NAME = 'documenti';
    const COMMUNITY_MODULE_NAME = 'community';

    public function safeUp()
    {
        $communityModule = \Yii::$app->getModule('community');
        if(isset($communityModule)) {
            $this->insert('amos_widgets', [
                'classname' => \arter\amos\documenti\widgets\graphics\WidgetGraphicsDocumentsExplorer::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::COMMUNITY_MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 1,
                'sub_dashboard' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        }

        return true;
    }

    public function safeDown()
    {
        $communityModule = \Yii::$app->getModule('community');
        if(isset($communityModule)) {
            $this->delete('amos_widgets', [
                'classname' => \arter\amos\documenti\widgets\graphics\WidgetGraphicsDocumentsExplorer::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::COMMUNITY_MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 1,
                'sub_dashboard' => 1,
            ]);
        }
        return true;
    }

}
