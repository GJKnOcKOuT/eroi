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

/**
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps;

use Yii;
use yii\web\AssetBundle;

/**
 * MapAsset
 *
 * Registers the google maps api
 *
 * To update the key or other options like language, version, or library
 * use the Asset Bundle customization.
 * http://www.yiiframework.com/doc-2.0/guide-structure-assets.html#customizing-asset-bundles
 * To get key, please visit https://code.google.com/apis/console/
 *
 *      'components' => [
 *          'assetManager' => [
 *              'bundles' => [
 *                  'dosamigos\google\maps\MapAsset' => [
 *                      'options' => [
 *                          'key' => 'this_is_my_key',
 *                          'language' => 'id',
 *                          'version' => '3.1.18'
 *                      ]
 *                  ]
 *              ]
 *          ],
 *      ],
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class MapAsset extends AssetBundle
{
    /**
     * Sets options for the google map
     * @var array
     */
    public $options = [];
    /**
     * @inheritdoc
     */
    public function init()
    {

	// BACKWARD COMPATIBILITY
	// To configure please, add `googleMapsApiKey` parameter to your application configuration
	// file with the value of your API key. To get yours, please visit https://code.google.com/apis/console/.
	$key = @Yii::$app->params['googleMapsApiKey'];
	// To configure please, add `googleMapsLibraries` parameter to your application configuration
	$libraries = @Yii::$app->params['googleMapsLibraries'];
	// To configure please, add `googleMapsLanguage` parameter to your application configuration
	$language = @Yii::$app->params['googleMapsLanguage'];

	$this->options = array_merge($this->options, array_filter([
            'key' => $key,
            'libraries' => $libraries,
            'language' => $language
	]));
	// BACKWARD COMPATIBILITY

        $this->js[] = '//maps.googleapis.com/maps/api/js?'. http_build_query($this->options);
    }
} 
