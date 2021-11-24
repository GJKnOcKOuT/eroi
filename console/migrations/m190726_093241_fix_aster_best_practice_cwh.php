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

use arter\amos\best\practice\models\BestPractice;
use arter\amos\tag\models\EntitysTagsMm;
use yii\db\ActiveQuery;
use yii\db\Migration;
use yii\db\Query;

/**
 * Class m190726_093241_fix_aster_best_practice_cwh
 */
class m190726_093241_fix_aster_best_practice_cwh extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $adminId = 1;
        $cwhConfigUserId = 2;
        $cwhRegolaPubblicazioneAllId = 1;
        $cwhRegolaPubblicazioneId = $cwhRegolaPubblicazioneAllId;
        $cwhRegolaPubblicazioneWithTagsId = 2;
        $bestPracticeCwhConfigContentId = 6;
        $bestPracticeTable = 'best_practice';
        $cwhPubblicazioniTable = 'cwh_pubblicazioni';
        $cwhPubblicazioniCwhNodiValidatoriMmTable = 'cwh_pubblicazioni_cwh_nodi_validatori_mm';
        $maxBestPracticeIdToManage = 215;

        $query = new Query();
        $allBestPractices = $query->from($bestPracticeTable)->where(['<=', 'id', $maxBestPracticeIdToManage])->all();

        foreach ($allBestPractices as $bestPractice) {
            /** @var ActiveQuery $query */
            $query = EntitysTagsMm::find();
            $query->andWhere(['record_id' => $bestPractice['id']]);
            $query->andWhere(['classname' => BestPractice::className()]);
            $entityTagsMms = $query->count();
            $cwhRegolaPubblicazioneId = (($entityTagsMms > 0) ? $cwhRegolaPubblicazioneWithTagsId : $cwhRegolaPubblicazioneAllId);
            $this->insert($cwhPubblicazioniTable, [
                'content_id' => $bestPractice['id'],
                'cwh_config_contents_id' => $bestPracticeCwhConfigContentId,
                'cwh_regole_pubblicazione_id' => $cwhRegolaPubblicazioneId,
                'created_at' => $bestPractice['created_at'],
                'created_by' => $bestPractice['created_by'],
                'updated_at' => $bestPractice['updated_at'],
                'updated_by' => $bestPractice['updated_by'],
                'deleted_at' => $bestPractice['deleted_at'],
                'deleted_by' => $bestPractice['deleted_by'],
            ]);
        }

        $queryPubblicazioni = new Query();
        $bestPracticeCwhPubblicazioni = $queryPubblicazioni->from($cwhPubblicazioniTable)->where([
            'cwh_config_contents_id' => $bestPracticeCwhConfigContentId,
            'cwh_regole_pubblicazione_id' => $cwhRegolaPubblicazioneId
        ])->andWhere(['<=', 'content_id', $maxBestPracticeIdToManage])->all();

        foreach ($bestPracticeCwhPubblicazioni as $cwhPubblicazioni) {
            $this->insert($cwhPubblicazioniCwhNodiValidatoriMmTable, [
                'cwh_pubblicazioni_id' => $cwhPubblicazioni['id'],
                'cwh_config_id' => $cwhConfigUserId,
                'cwh_network_id' => $adminId,
                'cwh_nodi_id' => 'user-' . $adminId,
                'created_at' => $cwhPubblicazioni['created_at'],
                'created_by' => $cwhPubblicazioni['created_by'],
                'updated_at' => $cwhPubblicazioni['updated_at'],
                'updated_by' => $cwhPubblicazioni['updated_by'],
                'deleted_at' => $cwhPubblicazioni['deleted_at'],
                'deleted_by' => $cwhPubblicazioni['deleted_by'],
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190726_093241_fix_aster_best_practice_cwh cannot be reverted.\n";

        return false;
    }
}
