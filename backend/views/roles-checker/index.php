<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 */

/**
 *
 * @var $Roles \yii\rbac\Role[]
 * @var $this \yii\web\View
 */

$AuthManager = Yii::$app->getAuthManager();
$items = [];
$item = 0;
$countRoles = count($Roles);
$this->title = Yii::t('amosplatform', "Verifica i {numeroRuoli} di {appName}", [
    'numeroRuoli' => $countRoles,
    'appName' => Yii::$app->name
]);

?>


<?php foreach ($Roles as $k => $Role): ?>

    <?php
    $SubRoles = $AuthManager->getChildRoles($Role->name);

    $SubPermissions = $AuthManager->getChildren($Role->name);

    $countSubRoles = count($SubRoles);
    $countSubPermissions = count($SubPermissions);
    ?>

    <?php
    $this->beginBlock('gridViewSubRoles');
    ?>

    <?=
    \arter\amos\core\helpers\Html::tag('div',
        \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $SubRoles,

            ]),
            'columns' => [
                'type',
                'name',
                'description',
            ]
        ]),
        [
            'class' => 'col-lg-6'
        ]);

    ?>


    <?php
    $this->endBlock();
    ?>


    <?php
    $this->beginBlock('gridViewSubPermissions');
    ?>

    <?=
    \arter\amos\core\helpers\Html::tag('div',
        \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $SubPermissions,
            ]),
            'columns' => [
                'type',
                'name',
                'description',
            ]
        ]),
        [
            'class' => 'col-lg-6'
        ]);

    ?>


    <?php
    $this->endBlock();
    ?>


    <?php
    $item++;
    $items[] = [
        'header' => "
        #$item <strong>{$Role->name}</strong>
        <br /><br />
        <small class='pull-left'>{$Role->description}</small>
        <div class='pull-right'>{$countSubRoles} Ruoli / {$countSubPermissions} Permessi</div>
         <br /> 
       
  ",
        'content' => $this->blocks['gridViewSubRoles'] .
            $this->blocks['gridViewSubPermissions'] .
            \arter\amos\core\helpers\Html::tag('div', '', [
                'class' => 'clearfix'
            ])

    ];
    ?>

<?php endforeach; ?>



<?= \yii\jui\Accordion::widget([
    'items' => $items,
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['tag' => 'h3'],
    'clientOptions' => ['collapsible' => true],
]); ?>