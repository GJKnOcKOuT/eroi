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
 * @package    arter\amos\community\views\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

echo \arter\amos\community\widgets\CommunityMembersWidget::widget([
    'model' => $model,
    'showRoles' => $showRoles,
    'showAdditionalAssociateButton' => $showAdditionalAssociateButton,
    'additionalColumns' => $additionalColumns,
    'viewEmail' => $viewEmail,
    'checkManagerRole' => $checkManagerRole,
    'addPermission' => $addPermission,
    'manageAttributesPermission' => $manageAttributesPermission,
    'forceActionColumns' => $forceActionColumns,
    'actionColumnsTemplate' => $actionColumnsTemplate,
    'viewM2MWidgetGenericSearch' => $viewM2MWidgetGenericSearch,
    'targetUrlParams' => $targetUrlParams,
    'enableModal' => $enableModal,
    'gridId' => $gridId,
    'communityManagerRoleName' => $communityManagerRoleName
]);


?>