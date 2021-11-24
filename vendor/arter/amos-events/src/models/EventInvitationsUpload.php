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
 * @package    openinnovation\organizations\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\models;

use arter\amos\events\AmosEvents;
use yii\base\Model;
use yii\web\UploadedFile;

class EventInvitationsUpload extends Model
{

    public $excelFile;

    public function rules()
    {
        return [
            [['excelFile'], 'file', 'extensions' => 'xls, xlsx'],
        ];
    }
    
    public function parse()
    {
        $this->excelFile = UploadedFile::getInstance($this, 'excelFile');
        if ($this->validate()) {
            try {
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->excelFile->tempName);
                $worksheet = $spreadsheet->getActiveSheet();
                $highestRow = $worksheet->getHighestDataRow();
                // $highestColumn = $worksheet->getHighestColumn();
                // $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                for ($r = 2; $r <= $highestRow; ++$r) { // Skip first row
                    $rows[] = [
                        'email' => $worksheet->getCellByColumnAndRow(3, $r)->getValue(),
                        'fiscal_code' => $worksheet->getCellByColumnAndRow(4, $r)->getValue(),
                        'name' => $worksheet->getCellByColumnAndRow(1, $r)->getValue(),
                        'surname' => $worksheet->getCellByColumnAndRow(2, $r)->getValue(),
                    ];
                }
                return $rows;
            } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return false;
        }
    }

   public function attributeLabels()
    {
        return [
            'excelFile' => AmosEvents::txt('#invitations_excel_file'),
        ];
    }
}