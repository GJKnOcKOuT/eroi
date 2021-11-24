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

use arter\amos\core\behaviors\BlameableBehavior;
use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\tag\models\EntitysTagsMm;
use arter\amos\tag\models\Tag;
use yii\db\ActiveQuery;
use yii\db\Migration;

/**
 * Class m181030_094355_populate_tematiche_smart_specialization_strategy_tree
 */
class m190104_174355_import_organization_fix extends Migration
{
    /**
     * @return bool|void
     * @throws PHPExcel_Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function safeUp()
    {

        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->truncateTable('profilo');
        $this->truncateTable('profilo_sedi');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');

        $base = \Yii::getAlias('@backend').'/';
        $file = 'import_files/17122018 - ImportOrganizzazioni.xlsx';

        $inputFileName = $base . $file;

        //  Read your Excel workbook
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        $trovato = [];
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);

            if ($row > 1) {
                    if (!empty($rowData[0][0]) && !empty($rowData[0][3])) {
                        $this->importOrganizations($rowData[0]);
                    }
            }
        }


    }

    /**
     * @param $rowData
     * @throws \yii\base\InvalidConfigException
     */
    private function importOrganizations($rowData){
        $organization = new \arter\amos\organizzazioni\models\Profilo();
        $organization->name = $rowData[0];
        $organization->partita_iva = null;
        $organization->codice_fiscale = null;
        $organization->presentazione_della_organizzaz = $rowData[3];
        $organization->email = str_replace('Contatto ASTER: ','', $rowData[9]);
        $organization->telefono = $rowData[10];
        $organization->fax = $rowData[11];
        $organization->pec = $rowData[12];
        $organization->responsabile = $rowData[13];
        $organization->sito_web = $rowData[14];
        $organization->facebook = $rowData[15];
        $organization->linkedin = $rowData[16];
        $organization->twitter = $rowData[17];
        $organization->google = $rowData[18];


        $organization->tipologia_di_organizzazione = 14;
        $organization->forma_legale = 16;
        $organization->la_sede_legale_e_la_stessa_del = true;

        $placeId = $this->saveAddress($rowData[4], $rowData[5], $rowData[6],  $rowData[7], $rowData[8] );
        if($placeId) {
            $organization->mainOperativeHeadquarterAddress = $placeId;
        }


        $organization->save(false);
        if($placeId){
            $organization->mainOperativeHeadquarterAddress = $placeId;

            $sedeOperativa = new \arter\amos\organizzazioni\models\ProfiloSediOperative();
            $sedeOperativa->address = $placeId;
            $sedeOperativa->profilo_id = $organization->id;
            $sedeOperativa->is_main = 1;
            $sedeOperativa->email = $organization->email;
            $sedeOperativa->phone = $organization->telefono;
            $sedeOperativa->fax = $organization->fax;
            $sedeOperativa->pec = $organization->pec;
            $sedeOperativa->save(false);

            $sedeLegale = new \arter\amos\organizzazioni\models\ProfiloSediLegal();
            $sedeLegale->address = $placeId;
            $sedeLegale->profilo_id = $organization->id;
            $sedeLegale->is_main = 1;
            $sedeLegale->email = $organization->email;
            $sedeLegale->phone = $organization->telefono;
            $sedeLegale->fax = $organization->fax;
            $sedeLegale->pec = $organization->pec;
            $sedeLegale->save(false);
        }


        $tags = explode(',', $rowData[21]);
        foreach ($tags as $tagId){
            $tag = Tag::findOne($tagId);
            if($tag) {
                $tagMm = new EntitysTagsMm();
                $tagMm->classname = \arter\amos\organizzazioni\models\Profilo::className();
                $tagMm->record_id = $organization->id;
                $tagMm->tag_id = $tag->id;
                $tagMm->root_id = $tag->root;
                $tagMm->save(false);
            }
        }
    }

    /**
     * @param $via
     * @param $civico
     * @param $comune
     * @param $provincia
     * @param $cap
     * @throws \yii\base\InvalidConfigException
     */
    private function saveAddress($via, $civico, $comune, $provincia, $cap){
        $address = $via.', '.$civico.", ".$comune. ' '.$provincia;
        $placeId = \arter\amos\organizzazioni\components\OrganizationsPlacesComponents::getGoogleResponseByGeocodeString($address, true);
        return $placeId;
    }



    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m181030_094355_populate_tematiche_smart_specialization_strategy_tree cannot be reverted.\n";

        return true;
    }
}
