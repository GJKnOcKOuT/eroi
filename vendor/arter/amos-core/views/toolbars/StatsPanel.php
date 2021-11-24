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


use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

class StatsPanel extends BaseObject implements IStatsPanel
{

    private $icon;
    private $label;
    private $description;
    private $count;
    private $url;

    /**
     * @var bool $disableLink
     */
    private $disableLink = false;

    public function getIcon()
    {
       return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function getDisableLink()
    {
        return $this->disableLink;
    }

    /**
     * @param bool $disableLink
     */
    public function setDisableLink($disableLink)
    {
        $this->disableLink = $disableLink;
    }

    /**
     * @param $type
     * @return string
     */
    public function render($type)
    {
        $html = '';

        if($type){
            $html = $this->renderJavascript();
        }else{
            $html = $this->renderHtml();
        }
        return $html;
    }

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

        $url = null;
        $options = [
            'title' => $this->description,
            'href' => "javascript:$('[data-toggle=\"tab\"], [data-toggle=\"pill\"]').filter('[href=\"#' + '" . $this->url . "'.match(/#(.*)/)[1] + '\"]').tab('show');"
        ];
        return \arter\amos\core\helpers\Html::a(
            "{$this->icon} {$this->count} {$this->label}",
            $url,$options);
    }
}