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
 * @package    arter\amos\attachments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\attachments\components;

use arter\amos\attachments\FileModule;
use Yii;
use yii\base\Component;
use yii\db\ActiveRecord;

/**
 * Class FileImport
 * @package arter\amos\attachments\components
 */
class FileImport extends Component
{
    /**
     * Import single file on selected Model->attribute
     * @param $modelSpecific ActiveRecord The Record owner of the file
     * @param $attribute string The attribute Name
     * @param $filePath string Path on filesystem
     * @return bool|array File format or Array with error
     */
    public function importFileForModel($modelSpecific, $attribute, $filePath, $dropOriginFile = true)
    {
        $module = Yii::$app->getModule(FileModule::getModuleName());

        //Se non esiste salto
        if (!file_exists($filePath)) {
            return false;
        }

        $file = [];
        $file['name'] = basename($filePath);
        $file['tempName'] = $filePath;
        $file['type'] = mime_content_type($filePath);
        $file['size'] = filesize($filePath);

        if ($module->attachFile($filePath, $modelSpecific, $attribute,$dropOriginFile)) {
            $result['uploadedFiles'] = [$filePath];
            return $result;
        } else {
            return [
                'error' => $modelSpecific->getErrors(),
                'ioca' => $modelSpecific->getErrors()
            ];
        }
    }
}
