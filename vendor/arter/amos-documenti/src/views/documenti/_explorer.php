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
 * @package    arter\amos\documenti\views\documenti
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

Yii::$app->controller->module->params['orderParams'] = null;
Yii::$app->controller->module->params['searchParams'] = null;
Yii::$app->view->params['createNewBtnParams'] = ['layout' => ''];

echo $this->render(
    '@vendor/arter/amos-documenti/src/widgets/graphics/views/documents-explorer/documents_explorer.php',
    [
        'explorer' => false,
    ]
);