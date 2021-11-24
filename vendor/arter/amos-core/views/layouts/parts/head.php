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
 * @package    arter\amos\core\views\layouts\parts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/* use arter\amos\audit\assets\JSLoggingAsset; */
use yii\helpers\Html;

$moduleL = \Yii::$app->getModule('layout');
if(!empty($moduleL))
{ 
    arter\amos\layout\assets\BaseAsset::register($this); 
}
else
{ 
    arter\amos\core\views\assets\AmosCoreAsset::register($this); 
}

/* JSLoggingAsset::register($this); */
?>

<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?= Html::encode(Yii::$app->name) ?> - <?= Html::encode($this->title) ?></title>
<!--<link rel="stylesheet" type="text/css" href="/css/print_style.css" media="print">-->
<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/<?= Yii::$app->params['favicon'] ?>" type="image/x-icon" />
<?php $this->head() ?>
<!--[if lt IE 9]>
  <script src="/frontend/js/html5shiv.js"></script>
  <script src="/frontend/js/respond.js"></script> 
<![endif]-->
<script type="text/javascript">
    var isIE9TO11 = navigator.appVersion.indexOf("Trident/");
    if (isIE9TO11 > -1) {/*! svg4everybody v1.0.0 | github.com/jonathantneal/svg4everybody */
(function (document, uses, requestAnimationFrame, CACHE, IE9TO11) {
	function embed(svg, g) {
		if (g) {
			var
			viewBox = g.getAttribute('viewBox'),
			fragment = document.createDocumentFragment(),
			clone = g.cloneNode(true);

			if (viewBox) {
				svg.setAttribute('viewBox', viewBox);
			}

			while (clone.childNodes.length) {
				fragment.appendChild(clone.childNodes[0]);
			}

			svg.appendChild(fragment);
		}
	}

	function onload() {
		var xhr = this, x = document.createElement('x'), s = xhr.s;

		x.innerHTML = xhr.responseText;

		xhr.onload = function () {
			s.splice(0).map(function (array) {
				embed(array[0], x.querySelector('#' + array[1].replace(/(\W)/g, '\\$1')));
			});
		};

		xhr.onload();
	}

	function onframe() {
		var use;

		while ((use = uses[0])) {
			var
			svg = use.parentNode,
			url = use.getAttribute('xlink:href').split('#'),
			url_root = url[0],
			url_hash = url[1];

			svg.removeChild(use);

			if (url_root.length) {
				var xhr = CACHE[url_root] = CACHE[url_root] || new XMLHttpRequest();

				if (!xhr.s) {
					xhr.s = [];

					xhr.open('GET', url_root);

					xhr.onload = onload;

					xhr.send();
				}

				xhr.s.push([svg, url_hash]);

				if (xhr.readyState === 4) {
					xhr.onload();
				}

			} else {
				embed(svg, document.getElementById(url_hash));
			}
		}

		requestAnimationFrame(onframe);
	}

	if (IE9TO11) {
		onframe();
	}
})(
	document,
	document.getElementsByTagName('use'),
	window.requestAnimationFrame || window.setTimeout,
	{},
	/Trident\/[567]\b/.test(navigator.userAgent) || /Edge\/12/.test(navigator.userAgent) || (navigator.userAgent.match(/AppleWebKit\/(\d+)/) || [])[1] < 538
);
}
</script>

<!--[if lte IE 8]>
<script type="text/javascript" src="/js/svg4everybody.legacy.js"></script>
<![endif]-->