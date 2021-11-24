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
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


class IconView extends BaseListView
{
    public $name = 'icon';

    public $layout = "{items}\n{pager}";

    public $fields = [

    ];

    public $containerOptions = [
        'id' => 'dataViewListContainer',
        'class'=>'row'
    ];

    public $itemOptions = [
        "class" => "col-xs-12 col-sm-6 col-md-4 col-lg-3",
        "aria-selected" => "false",
        "role" => "option"
    ];


    public $itemPerRow = ['xs' => 6];

    /**
     * @var array additional parameters to be passed to [[itemView]] when it is being rendered.
     * This property is used only when [[itemView]] is a string representing a view name.
     */
    public $viewParams = [];
    /**
     * @var string the HTML code to be displayed between any two consecutive items.
     */
    public $separator = "";
    /**
     * @var array the HTML attributes for the container tag of the list view.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'icon-view'];

}