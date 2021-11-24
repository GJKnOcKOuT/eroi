<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace arter\amos\core\forms;

use arter\amos\core\module\BaseAmosModule;
use kartik\password\PasswordInput as KartikPasswordInput;
use yii\web\View;
use Yii;

class PasswordInput extends KartikPasswordInput
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        if (empty($this->pluginOptions['inputTemplate'])){
            $this->pluginOptions['inputTemplate'] = $this->renderInputTemplate();
        }

        parent::run();
    }

	/**
	 * Override kartik's default input template to customize with eye
	 * This methos is called only if the widget is not configuring a custom template
	 */
    protected function renderInputTemplate()
    {
        $class = 'password-input-group';

        $content = '{input}<span class="input-group-addon eye-toggle-box am am-eye-off" title="'. Yii::t('amoscore','#hide_show_password') .'"></span>';

        if ($this->size === 'lg' || $this->size === 'sm') {
            $class .= ' input-group-' . $this->size;
        }

        if ($this->togglePlacement === 'left') {
            $content = '<span class="input-group-addon eye-toggle-box am am-eye-off" title="'. Yii::t('amoscore','#hide_show_password') .'"></span>{input}';
        }

        $view = $this->getView();
        $moduleL = \Yii::$app->getModule('layout');
        if(!empty($moduleL))
        {
            \arter\amos\layout\assets\PasswordInputAsset::register($view);
        }
        else
        {
            \arter\amos\core\views\assets\PasswordInputAsset::register($view);
        }

        return "<div class='{$class}'>{$content}</div>";
    }
}