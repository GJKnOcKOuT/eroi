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
 * @package    arter\amos\community\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\models;

use yii\base\Model;

/**
 * Class CommunityReport
 * @package arter\amos\community\models
 */
class CommunityReport extends Model
{
    /**
     * @var int $id
     */
    public $id;
    
    /**
     * @var string $title
     */
    public $title;
    
    /**
     * @var mixed $reportValue
     */
    public $reportValue;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'reportValue'], 'safe'],
            [['title'], 'string'],
            [['id'], 'integer'],
        ];
    }
}
