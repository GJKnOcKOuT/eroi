<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Class m190524_080840_fix_aster_attach_file_model_user_profile
 */
class m190524_080840_fix_aster_attach_file_model_user_profile extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update(
            'attach_file',
            ['model' => \backend\modules\aster_admin\models\UserProfile::className()],
            ['model' => \arter\amos\admin\models\UserProfile::className()]
        );
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190524_080840_fix_aster_attach_file_model_user_profile cannot be reverted.\n";
        return false;
    }
}
