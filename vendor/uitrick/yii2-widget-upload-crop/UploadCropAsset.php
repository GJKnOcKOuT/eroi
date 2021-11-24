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
 * Asset bundle for uploadCrop Widget
 *
 * @author Joseba Juaniz <joseba.juaniz@gmail.com>
 * @since 1.0
 */

namespace uitrick\yii2\widget\upload\crop;

use yii\web\AssetBundle;

class UploadCropAsset extends AssetBundle
{

	public $depends = [
		'yii\web\JqueryAsset'
	];

	public function init()
	{
		$this->sourcePath = __DIR__ . '/assets';

		$this->js[] = (YII_DEBUG ? 'js/uploadcrop.js' : 'js/uploadcrop.min.js');
		$this->js[] = (YII_DEBUG ? 'js/cropper.js' : 'js/cropper.min.js');
		
		$this->css[] = (YII_DEBUG ? 'css/cropper.css' : 'css/cropper.min.css');
		$this->css[] = (YII_DEBUG ? 'css/uploadcrop.css' : 'css/uploadcrop.min.css');
		parent::init();
	}
}