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


Swift_DependencyContainer::getInstance()
    ->register('cache')
    ->asAliasOf('cache.array')

    ->register('tempdir')
    ->asValue('/tmp')

    ->register('cache.null')
    ->asSharedInstanceOf('Swift_KeyCache_NullKeyCache')

    ->register('cache.array')
    ->asSharedInstanceOf('Swift_KeyCache_ArrayKeyCache')
    ->withDependencies(['cache.inputstream'])

    ->register('cache.disk')
    ->asSharedInstanceOf('Swift_KeyCache_DiskKeyCache')
    ->withDependencies(['cache.inputstream', 'tempdir'])

    ->register('cache.inputstream')
    ->asNewInstanceOf('Swift_KeyCache_SimpleKeyCacheInputStream')
;
