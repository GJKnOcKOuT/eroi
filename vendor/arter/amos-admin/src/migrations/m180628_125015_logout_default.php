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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;
use arter\amos\admin\models\UserProfile;

/**
 * Class m180628_125015_logout_default
 */
class m180628_125015_logout_default extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update(
            UserProfile::tableName(),
            ['ultimo_logout' => new \yii\db\Expression('ultimo_accesso')],
            ['is', 'ultimo_logout', null]
        );

        $this->alterColumn(
            UserProfile::tableName(),
            'ultimo_logout',
            $this->dateTime()->defaultValue(new \yii\db\Expression('now()'))->comment('Ultimo logout')
        );

        $this->update(
            UserProfile::tableName(),
            ['ultimo_logout' => new \yii\db\Expression('now()')],
            new \yii\db\Expression('CAST(ultimo_logout AS CHAR(20)) = \'0000-00-00 00:00:00\'')
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }

}