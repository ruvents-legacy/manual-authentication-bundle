# RUVENTS Manual Authentication Bundle

## Configuration

```yaml
# app/config/security.yml
security:
  firewalls:
    dev:
      pattern:  ^/(_(profiler|wdt)|css|images|js)/
      security: false

    main:
      # add manual auth to any firewall (it has no options)
      manual: ~
      anonymous: ~
      provider: user_entity_provider
      form_login:
        # ...
      logout:
        # ...
      remember_me:
        secret: "%secret%"
        always_remember_me: true
```

## Authenticating a User in the controller

```php
<?php

namespace AppBundle\Controller;

use Ruvents\ManualAuthenticationBundle\Security\AuthenticationList;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/registration")
 */
class RegistrationController
{
    /**
     * @Route("")
     * @Template()
     */
    public function indexAction(AuthenticationList $authenticationList)
    {
        // registration form and etc
        
        /** @var UserInterface $user */
        
        // on form success
        
        // you have to create relevant Tokens
        // f.e. PostAuthenticationGuardToken for Guard auth
        $token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());
        $authenticationList->setToken('main', $token);
        
        // redirect to next page
    }
}
```
