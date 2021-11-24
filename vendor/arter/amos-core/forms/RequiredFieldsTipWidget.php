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
use arter\amos\core\module\BaseAmosModule;
use yii\base\Widget;

/**
 * Class RequiredFieldsTipWidget
 * @package arter\amos\core\forms
 */
class RequiredFieldsTipWidget extends Widget
{
    /**
     * @var string $layout
     */
    public $layout = '{requiredTip}';

    /**
     * @var string $containerClasses
     */
    public $containerClasses = 'col-xs-12 note_asterisk nop';

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @inheritdoc
     */
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
            case '{requiredTip}':
                return $this->renderTip();
            default:
                return false;
        }
    }

    /**
     * Render the tip.
     * @return string
     */
    public function renderTip()
    {
        $tip = Html::beginTag('div', ['class' => $this->containerClasses]);
        $tip .= Html::tag('p', BaseAmosModule::t('amoscore', 'The fields marked with * are required.'));
        $tip .= Html::endTag('div');
        return $tip;
    }
}
