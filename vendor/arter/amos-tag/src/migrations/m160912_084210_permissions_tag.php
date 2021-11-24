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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

class m160912_084210_permissions_tag extends \yii\db\Migration
{

    const TABLE_PERMISSION = '{{%auth_item}}';

    public function safeUp()
    {        
        $this->insert(self::TABLE_PERMISSION, [
            'name' => \arter\amos\tag\widgets\icons\WidgetIconTag::className(),
            'type' => '2',
            'description' => 'Permesso di VIEW sul widget WidgetIconTag'
        ]);
        $this->insert(self::TABLE_PERMISSION, [
            'name' => \arter\amos\tag\widgets\icons\WidgetIconTagManager::className(),
            'type' => '2',
            'description' => 'Permesso di VIEW sul widget WidgetIconTagManager'
        ]);
    }

    public function safeDown()
    {
        $this->delete(self::TABLE_PERMISSION, [
            'name' => \arter\amos\tag\widgets\icons\WidgetIconTag::className()
        ]);
        echo "Eliminato il permesso: " . 'WIDGETICONTAG_VIEW';
        $this->delete(self::TABLE_PERMISSION, [
            'name' => \arter\amos\tag\widgets\icons\WidgetIconTagManager::className()
        ]);
        echo "Eliminato il permesso: " . 'WIDGETICONTAGMANAGER_VIEW';
        return true;
    }

}