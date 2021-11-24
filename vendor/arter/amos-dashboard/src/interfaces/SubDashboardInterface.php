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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\interfaces;

use yii\db\ActiveQuery;

/**
 * Interface CommunityContextInterface
 * @package arter\amos\community\models
 */
interface SubDashboardInterface
{
    /**
     * Array containing the classname of the widget to be present in the sub-dashboard
     * @param array $config
     */
    public function setModuleSubDashboard($config);

    /**
     * The name of the basic member role
     * @return string
     */
    public function getBaseRole();

    /**
     * The name of the greatest role a member can have
     * @return string
     */
    public function getManagerRole();

    /**
     * Array containing user permission for a given role
     * @param string $role
     * @return array
     */
    public function getRolePermissions($role);

    /**
     * The community created by the context model (community related to project-management, events or a community itself)
     * @return Community
     */
    public function getCommunityModel();

    /**
     * Array containing the next level for a given initial role
     * @param string $role
     * @return string
     */
    public function getNextRole($role);

    /**
     * For m2m widget actions: return the plugin module name to construct redirect URL
     * @return string
     */
    public function getPluginModule();

    /**
     * For m2m widget actions: return the plugin controller name to construct redirect URL
     * @return string
     */
    public function getPluginController();

    /**
     * For m2m widget actions: return the controller action name to construct redirect URL
     * @return string
     */
    public function getRedirectAction();

    /**
     * Active query to search the users to associate in the additional association page
     *
     * @param integer $communityId Id of the community created by the context model
     * @return ActiveQuery
     */
    public function getAdditionalAssociationTargetQuery($communityId);

}