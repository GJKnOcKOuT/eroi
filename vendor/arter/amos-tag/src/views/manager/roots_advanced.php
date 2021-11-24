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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\tag\AmosTag;

/** @var \yii\web\View $this */
/** @var \kartik\form\ActiveForm $form */
/** @var \arter\amos\tag\models\Tag $node */

if ($node->isRoot()):
    $moduliTaggabili = [];
    /** @var \arter\amos\core\module\AmosModule $module */
    $moduleTag = \Yii::$app->getModule(\arter\amos\tag\AmosTag::getModuleName());
    foreach ($moduleTag->modelsEnabled as $module) {
        $function = new \ReflectionClass($module);
        $moduliTaggabili[$module] = $function->getShortName();
    }
    $ruoliDaScegliere = [];
    foreach (Yii::$app->getAuthManager()->getRoles() as $key => $ruolo) {
        $ruoliDaScegliere[$key] = $ruolo->name;
    }

    /**
     * TODO
     * Attenzione: integrare la select2 nel model $node, così va bene ma non benissimo...
     */


    $i =0;
    foreach ($moduliTaggabili as $keyModule => $moduleName):
        ?>

        <div class="row">
            <div class="col-sm-6">
                <h4><?= AmosTag::tHtml('amostag','Abilita questa root per: ') . $moduleName ?></h4>
            </div>
            <div class="col-sm-12">
                <div class="checkbox">
                    <?= \kartik\select2\Select2::widget([
                        'name' => 'ModelsRoles[' . $keyModule . ']',
                        'value' => $node->getAssignedRolesByClassname($keyModule),
                        'data' => $ruoliDaScegliere,
                        'options' => ['placeholder' => AmosTag::t('amostag','Seleziona un ruolo...'), 'multiple' => true],
                        'id' => 'roleSelect'. $i ,
                        'pluginOptions' => [
                            'tags' => true,
                            'maximumInputLength' => 50
                        ],
                    ]); ?>

                </div>
            </div>
        </div>

        <?php
    $i++;
    endforeach;
    ?>
    <?php if (Yii::$app->getModule('cwh')): ?>

    <div class="row">
        <div class="col-sm-6">
            <h4><?= AmosTag::tHtml('amostag',"&Egrave; un albero per aree di interesse dell'utente?") ?></h4>
        </div>
        <div class="col-sm-12">
            <div class="checkbox">
                <?php
                echo \kartik\select2\Select2::widget([
                    'name' => 'CwhTagInterestMm[' . Yii::$app->getModule('admin')->modelMap['UserProfile'] . ']',
                    'value' => $node->getAssignedInterestByClassname(Yii::$app->getModule('admin')->modelMap['UserProfile']),
                    'data' => $ruoliDaScegliere,
                    'options' => ['placeholder' => AmosTag::t('amostag','Seleziona un ruolo...'), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 50
                    ],
                ]); ?>

            </div>
        </div>
    </div>
    <?php
endif;
    ?>

    <?php
endif;
?>