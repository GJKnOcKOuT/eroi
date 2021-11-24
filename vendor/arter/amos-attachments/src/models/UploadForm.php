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

namespace arter\amos\attachments\models;

use arter\amos\attachments\FileModuleTrait;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class UploadForm
 * @package arter\amos\attachments\models
 */
class UploadForm extends Model
{
    use FileModuleTrait;

    /**
     * @var UploadedFile[]|UploadedFile file attribute
     */
    public $file;

    /**
     * @var ActiveRecord
     */
    public $modelSpecific;

    /**
     * @var string
     */
    public $attributeSpecific;

    /**
     * @return bool
     *
     * public function beforeValidate()
     * {
     * $attributeValidators = $this->modelSpecific->getActiveValidators($this->attributeSpecific);
     *
     * foreach($attributeValidators as $validator) {
     * $validator->attributes = ['file'];
     * $this->validators->append($validator);
     * //$this->activeValidators[] = $validator;
     * }
     *
     * return parent::beforeValidate();
     * }*/
}