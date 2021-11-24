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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2018
 * @package yii2-social
 * @version 1.3.5
 */

/**
 * View template for yii\social\GoogleAnalytics widget
 *
 * @var string $obj
 * @var string $domain
 * @var string $trackerConfig
 * @var string $sendConfig
 * @var string $jsBeforeSend
 * @var string $jsAfterSend
 * @var string $noscript
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
?>
	<script async>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            };
            i[r].l = 1 * new Date();
            a = s.createElement(o);
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.defer = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', '<?= $obj ?>');

        <?= $obj ?>('create', '<?= $id ?>', '<?= $domain ?>'<?= $trackerConfig ?>);
        <?= $jsBeforeSend ?>
        <?= $obj ?>('send', 'pageview'<?= $sendConfig ?>);
        <?= $jsAfterSend ?>
	</script>
<?= $noscript ?>