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

/* @var $panel yii\debug\panels\ConfigPanel */
$extensions = $panel->getExtensions();
?>
    <h1>Configuration</h1>

<?php
$formatLanguage = function ($locale) {
    if (class_exists('Locale', false)) {
        $region = Locale::getDisplayLanguage($locale, 'en');
        $language = Locale::getDisplayRegion($locale, 'en');
        return ' (' . implode(',', array_filter([$language, $region])) . ')';
    }
    return '';
};
$app = $panel->data['application'];
echo $this->render('table', [
    'caption' => 'Application Configuration',
    'values' => [
        'Yii Version' => $app['yii'],
        'Application Name' => $app['name'],
        'Application Version' => $app['version'],
        'Current Language' => !empty($app['language']) ? $app['language'] . $formatLanguage($app['language']) : '',
        'Source Language' => !empty($app['sourceLanguage']) ? $app['sourceLanguage'] . $formatLanguage($app['sourceLanguage']) : '',
        'Charset' => !empty($app['charset']) ? $app['charset'] : '',
        'Environment' => $app['env'],
        'Debug Mode' => $app['debug'] ? 'Yes' : 'No',
    ],
]);

if (!empty($extensions)) {
    echo $this->render('table', [
        'caption' => 'Installed Extensions',
        'values' => $extensions,
    ]);
}

$memcache = 'Disabled';
if ($panel->data['php']['memcache']) {
    $memcache = 'Enabled (memcache)';
} elseif ($panel->data['php']['memcached']) {
    $memcache = 'Enabled (memcached)';
}

echo $this->render('table', [
    'caption' => 'PHP Configuration',
    'values' => [
        'PHP Version' => $panel->data['php']['version'],
        'Xdebug' => $panel->data['php']['xdebug'] ? 'Enabled' : 'Disabled',
        'APC' => $panel->data['php']['apc'] ? 'Enabled' : 'Disabled',
        'Memcache' => $memcache,
    ],
]);

echo $panel->getPhpInfo();
