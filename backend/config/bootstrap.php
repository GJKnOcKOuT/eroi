<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

$bootstrap = [];

$bootstrap[] = 'comments';
$bootstrap[] = 'arter\amos\core\bootstrap\Breadcrumb';
$bootstrap[] = 'workflow';
$bootstrap[] = 'translation';
$bootstrap[] = 'notify';
$bootstrap[] = 'arter\amos\translation\bootstrap\EventActiveRecordBootstrap';
//$bootstrap[] = 'arter\amos\translation\bootstrap\EventViewBootstrap';
$bootstrap[] = 'translatemanager';
$bootstrap[] = 'layout';
//$bootstrap[] = 'maintenanceMode';
$bootstrap[] = 'arter\amos\admin\bootstrap\RedirectAfterLogin';
$bootstrap[] = 'backend\components\LoginRequestInfoWizard';

return $bootstrap;
