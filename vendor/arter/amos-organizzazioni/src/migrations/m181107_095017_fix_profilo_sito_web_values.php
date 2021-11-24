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
use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\models\ProfiloSedi;
use arter\amos\organizzazioni\Module;
use yii\db\Migration;

/**
 * Class m181107_095017_fix_profilo_sito_web_values
 */
class m181107_095017_fix_profilo_sito_web_values extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $organizations = $this->findOrganizations();
        $ok = $this->fixOrganizationswebsiteToSitoWeb($organizations);
        if ($ok) {
            try {
                $this->dropColumn(ProfiloSedi::tableName(), 'website');
            } catch (\Exception $exception) {
                MigrationCommon::printConsoleMessage("Errore eliminazione colonna 'website' da ProfiloSedi");
                $ok = false;
            }
        }
        return $ok;
    }

    /**
     * @return Profilo[]
     * @throws \yii\base\InvalidConfigException
     */
    private function findOrganizations()
    {
        /** @var Profilo $profiloModel */
        $profiloModel = Module::instance()->createModel('Profilo');
        $query = $profiloModel::find();
        $organizations = $query->all();
        return $organizations;
    }

    /**
     * @param Profilo[] $organizations
     * @return bool
     */
    private function fixOrganizationswebsiteToSitoWeb($organizations)
    {
        foreach ($organizations as $organization) {
            $operativeHeadQuarter = $organization->operativeHeadquarter;
            $organization->sito_web = (!empty($operativeHeadQuarter) ? $operativeHeadQuarter->website : '');
            $ok = $organization->save(false);
            if (!$ok) {
                MigrationCommon::printConsoleMessage("Errore copia 'website' della sede operativa su 'sito_web' dell'organizzazione. ID organizzazione: " . $organization->id);
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m181107_095017_fix_profilo_sito_web_values cannot be reverted.\n";

        return false;
    }
}