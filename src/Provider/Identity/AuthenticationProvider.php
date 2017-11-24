<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Guard\CPanel\Provider\Identity;

use MSBios\Guard\Permission\Role;
use MSBios\Guard\Provider\Identity\AuthenticationProvider as DefaultAuthenticationProvider;
use MSBios\Guard\Provider\RoleProviderInterface;

use Zend\Authentication\AuthenticationServiceInterface;

/**
 * Class AuthenticationProvider
 * @package MSBios\Guard\CPanel\Provider\Identity
 */
class AuthenticationProvider extends DefaultAuthenticationProvider
{
    /** @var AuthenticationServiceInterface */
    protected $authenticationService;

    /**
     * AuthenticationProvider constructor.
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(AuthenticationServiceInterface $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @return array
     */
    public function getIdentityRoles()
    {
        /** @var RoleProviderInterface $identity */
        if ($identity = $this->authenticationService->getIdentity()) {

            /** @var array $roles */
            $roles = [];

            if ($identity instanceof RoleProviderInterface) {
                /** @var Role $role */
                foreach ($identity->getRoles() as $role) {
                    $roles[] = $role->getCode();
                }
            }

            if (empty($roles)) {
                $roles[] = $this->getAuthenticatedRole();
            }

            return $roles;

        }

        return parent::getIdentityRoles(); // TODO: Change the autogenerated stub
    }
}
