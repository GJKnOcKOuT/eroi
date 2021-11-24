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
 * @package    arter\amos\core\interfaces
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\interfaces;

/**
 * Interface OrganizationsModuleInterface
 * @package arter\amos\core\interfaces
 */
interface OrganizationsModuleInterface
{
    /**
     * @return string
     */
    public function getOrganizationModelClass();

    /**
     * @return string
     */
    public function getOrganizationCardWidgetClass();

    /**
     * @return string
     */
    public function getAssociateOrgsToProjectWidgetClass();

    /**
     * @return string
     */
    public function getAssociateOrgsToProjectTaskWidgetClass();

    /**
     * @return OrganizationsModelInterface[]
     */
    public function getOrganizationsListQuery();

    /**
     * @param int $user_id
     * @param int $organization_id
     * @return bool
     */
    public function saveOrganizationUserMm($user_id, $organization_id);

    /**
     * @param int $id
     * @return OrganizationsModelInterface|null
     */
    public function getOrganization($id);

    /**
     * This method returns all the organizations of an user.
     * @param int $userId
     * @return OrganizationsModelInterface[]
     */
    public function getUserOrganizations($userId);

    /**
     * This method returns all the headquarters of an user, if the module has headquarters.
     * @param int $userId
     * @return OrganizationsModelInterface[]
     */
    public function getUserHeadquarters($userId);
}
