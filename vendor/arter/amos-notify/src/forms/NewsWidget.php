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
 * @package    piattaforma-openinnovation
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\forms;

use arter\amos\notificationmanager\record\NotifyRecord;
use yii\base\Widget;
use yii\bootstrap\Html;

/**
 * Class NewsWidget
 * @package arter\amos\notificationmanager\forms
 */
class NewsWidget extends Widget {

  public $model;
  public $style;
  public $css_class = 'new-badge badge';

  /**
   * @inheritdoc
   */
  public function run() {
    if ($this->model instanceof NotifyRecord) {
      if ($this->model->isNews()) {
        echo Html::beginTag('div', ['class' => $this->css_class, 'style' => $this->style]);
        echo \Yii::t("amosnotify", "NEW");
        echo Html::endTag('div');
      }
    }
  }

}
