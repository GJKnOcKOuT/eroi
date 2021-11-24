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
 * @package    arter\amos\core\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views;

use arter\amos\core\views\common\BaseListView;
use Yii;

class ListView extends BaseListView
{
    public $name = 'list';

    public $layout = "{items}\n{pager}";

    public $template = '{view} {update} {delete}';
    public $buttons;
    public $buttonClass = 'arter\amos\core\views\common\Buttons';
    public $viewOptions = [
        'class' => ''
    ];
    public $updateOptions = [
        'class' => ''
    ];
    public $deleteOptions = [
        'class' => ''
    ];

    public $_isDropdown = false;


}
