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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;

use arter\amos\core\module\BaseAmosModule;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class EmailForm extends Model
{
    /**
     * @var string $message - custom message insert by user
     */
    public $message;

    /**
     * @var string $templatePath - email template path, leave null to use default template
     */
    public $templatePath;

    /**
     * @var string $attributeTo - model attribute specifying the recipient email address
     */
    public $attributeTo;

    /**
     * @var integer $userIdTo - User id of the mail recipient
     */
    public $userIdTo;

    /**
     * @var string $subject - email subject, leave null to use the default one
     */
    public $subject;

    public function rules()
    {
        return [
            [['message', 'templatePath', 'attributeTo', 'subject'], 'string'],
            ['userIdTo', 'integer'],
            ['message', 'required']
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'message' => BaseAmosModule::t('amoscore', '#message'),
        ]);
    }
}
