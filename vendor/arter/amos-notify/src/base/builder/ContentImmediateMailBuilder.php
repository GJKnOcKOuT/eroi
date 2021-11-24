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
 * @package    arter\amos\notificationmanager\base\builder
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\base\builder;

use arter\amos\notificationmanager\AmosNotify;

class ContentImmediateMailBuilder extends ContentMailBuilder
{

    /**
     * @param array $resultset
     * @return string
     */
    protected function renderContentHeader(array $resultset)
    {
        $controller = \Yii::$app->controller;
        $contents_number = count($resultset);

        $view = $controller->renderPartial("@vendor/arter/amos-" . AmosNotify::getModuleName() . "/src/views/email/content_immediate_email_header", [
            'contents_number' => $contents_number
        ]);

        $ris = $this->renderView(\Yii::$app->controller->module->name, "content_immediate_email_header", [
            'contents_number' => $contents_number,
            'original' => $view
        ]);

        return $ris;
    }

}