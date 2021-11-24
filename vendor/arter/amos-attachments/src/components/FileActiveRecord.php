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

use arter\amos\attachments\models\File;
use yii\db\ActiveRecord;

/**
 * Class FileActiveRecord
 * @package File\components
 * @property File[] files()
 * @method getInitialPreview()
 * @method getInitialPreviewConfig()
 * @method File[] getFiles()
 */
abstract class FileActiveRecord extends ActiveRecord
{

}