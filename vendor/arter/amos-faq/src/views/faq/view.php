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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\widgets\DetailView;
use arter\amos\faq\AmosFaq;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;

/**
 * @var yii\web\View $this
 * @var arter\amos\faq\models\Faq $model
 */

$this->title = $model->domanda;
$this->params['breadcrumbs'][] = ['label' => AmosFaq::t('amosfaq', 'Faq'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details_card">
    <div class="faq-stato-view">
        <div class="col-xs-12 right-column">
            <section class="section-data">
                <div class="body">
                        <?php
                        $checkPermTopicNew = true;
                        $pulsantiAdmin = [
                            Html::a(AmosFaq::tHtml('amosfaq', 'Modifica'), "/faq/faq/update?id=" . $model->id, ['model' => $model], $checkPermTopicNew, ['title' => 'modifica']),
                        ];
                        if (!empty($pulsantiAdmin)):
                            ?>
                            <div class="manage col-xs-12 text-right nop">
                                <div class="dropdown">
                                    <a class="manage-menu" data-toggle="dropdown" href="" aria-expanded="true" title="manage menu"><?= AmosIcons::show('more-vert') ?></a>
                                    <ul class="dropdown-menu pull-right">
                                        <?php
                                        foreach ($pulsantiAdmin as $pulsante) {
                                            ?>
                                            <li>
                                                <?php echo $pulsante; ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?= $model->risposta ?>
                </div>
            </section>
        </div>
    </div>
</div>