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

use arter\amos\core\helpers\Html;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

/**
 * Class CloseButtonWidget
 * Renders the close and submit buttons also according to the permissions that the user has.
 *
 * @package arter\amos\core\forms
 */
class CloseButtonWidget extends Widget
{
    /**
     * @var string
     */
    public $layout = "";

    /**
     * @var string $urlClose
     */
    private $urlClose;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $btnClass
     */
    private $btnClass;

    /**
     * @var string $layoutClass
     */
    private $layoutClass;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = '<div id="form-close-btn" class="bk-btnFormContainer';
        if (!is_null($this->layoutClass)) {
            $this->layout .= ' ' . $this->layoutClass;
        }
        $this->layout .= "\">{buttonClose}</div>";
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/", function ($matches) {
            $content = $this->renderSection($matches[0]);
            return $content === false ? $matches[0] : $content;
        }, $this->layout);

        return $content;
    }

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|boolean the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{buttonClose}':
                return $this->renderButtonClose();
            default:
                return false;
        }
    }

    public function renderButtonClose()
    {
        // Utile per la generazione automatica dell'inserimento rapido
        if (isset(\Yii::$app->controller->action->id) && substr_count(Yii::$app->controller->action->id, 'create-ajax')) {
            return '';
        }

        $options = [];

        if (!$this->getUrlClose()) {
            $this->setUrlClose(Url::previous());
        }

        if (!$this->getTitle()) {
            $this->setTitle(Yii::t('amoscore', 'Chiudi'));
        }

        if (!$this->getBtnClass()) {
            $this->setBtnClass('btn btn-secondary');
        }

        $options['title'] = $this->getTitle();
        $options['class'] = $this->getBtnClass();

        return Html::a($this->getTitle(), $this->getUrlClose(), $options);
    }

    /**
     * @return string
     */
    public function getUrlClose()
    {
        return $this->urlClose;
    }

    /**
     * @param $urlClose
     */
    public function setUrlClose($urlClose)
    {
        $this->urlClose = $urlClose;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBtnClass()
    {
        return $this->btnClass;
    }

    /**
     * @param mixed $btnClass
     */
    public function setBtnClass($btnClass)
    {
        $this->btnClass = $btnClass;
    }

    /**
     * @return string
     */
    public function getLayoutClass()
    {
        return $this->layoutClass;
    }

    /**
     * @param string $layoutClass
     */
    public function setLayoutClass($layoutClass)
    {
        $this->layoutClass = $layoutClass;
    }
}