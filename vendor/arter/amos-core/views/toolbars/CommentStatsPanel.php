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
 * @package    arter\amos\core\views\toolbars
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views\toolbars;

use yii\helpers\ArrayHelper;

class CommentStatsPanel extends StatsPanel
{
    /**
     * @return string
     */
    protected function renderHtml(){
        $url = $this->url;
        $options = [
            'title' => $this->description
        ];
        $content = "{$this->icon} ({$this->count}) {$this->label}";
        if ($this->disableLink) {
            return $content;
        } else {
            return \arter\amos\core\helpers\Html::a($content, $url, $options);
        }
    }

    /**
     * @return string
     */
    protected function renderJavascript(){

        return $this->renderHtml();
    }
}