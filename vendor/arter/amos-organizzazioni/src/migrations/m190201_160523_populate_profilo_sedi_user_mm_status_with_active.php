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
 * @package    arter\amos\organizzazioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\organizzazioni\models\ProfiloSediUserMm;
use arter\amos\organizzazioni\Module;
use yii\db\Migration;

/**
 * Class m190201_160523_populate_profilo_sedi_user_mm_status_with_active
 */
class m190201_160523_populate_profilo_sedi_user_mm_status_with_active extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            /** @var ProfiloSediUserMm $profiloUserMm */
            $profiloUserMm = Module::instance()->createModel('ProfiloSediUserMm');
            $this->update($profiloUserMm::tableName(), ['status' => ProfiloSediUserMm::STATUS_ACTIVE]);
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage($exception->getMessage());
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        try {
            /** @var ProfiloSediUserMm $profiloUserMm */
            $profiloUserMm = Module::instance()->createModel('ProfiloSediUserMm');
            $this->update($profiloUserMm::tableName(), ['status' => null]);
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage($exception->getMessage());
            return false;
        }
        return true;
    }
}
