<?php

namespace Ruvents\ManualAuthenticationBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class AuthenticationList
{
    private $tokens = [];

    public function setToken(string $firewall, TokenInterface $token = null): AuthenticationList
    {
        $this->tokens[$firewall] = $token;

        return $this;
    }

    public function hasToken(string $firewall): bool
    {
        return array_key_exists($firewall, $this->tokens);
    }

    /**
     * @param string $firewall
     *
     * @return null|TokenInterface
     * @throws \OutOfRangeException
     */
    public function pullToken(string $firewall)
    {
        if (!$this->hasToken($firewall)) {
            throw new \OutOfRangeException();
        }

        $token = $this->tokens[$firewall];

        unset($this->tokens[$firewall]);

        return $token;
    }
}
