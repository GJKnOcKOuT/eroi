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
use arter\amos\gantt\widgets\GanttWidget;

class GanttView extends BaseListView
{
    public $model = null;

    public $clientOptions = [

    ];

    public $drag_links_permissions = null;

    public function run()
    {
        return \arter\amos\core\helpers\Html::tag(
            $this->itemsContainerTag,
            GanttWidget::widget([
                'model' => $this->model,
                'clientOptions' => $this->clientOptions,
                'drag_links_permissions' => $this->drag_links_permissions
            ]),
            $this->itemsContainerOptions
        );
    }


}
