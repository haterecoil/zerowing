<?php
/**
 * Created by PhpStorm.
 * User: clarisse
 * Date: 2/22/16
 * Time: 7:33 AM
 */

namespace AppBundle\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;

class CredentialsAuthentificator implements SimplePreAuthenticatorInterface
{
    public function createToken(Request $request, $providerKey)
    {
        $content = $request->getContent();
        $input = json_decode($content, true);

        if (!($input['username'] && $input['password'])) {
            throw new BadCredentialsException('Missing username or password');
        }


        return new PreAuthenticatedToken(
            $input['username'],
            $input['password'],
            $providerKey
        );
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        if (!$userProvider instanceof ApiKeyUserProvider) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The user provider must be an instance of ApiKeyUserProvider (%s was given).',
                    get_class($userProvider)
                )
            );
        }

        $password = $token->getCredentials();
        $username = $token->getUsername();
        $user = $userProvider->getUser($username, $password);

        if (!$user) {
            // CAUTION: this message will be returned to the client
            // (so don't put any un-trusted messages / error strings here)
            throw new CustomUserMessageAuthenticationException('Invalid username or password');
        }



        return new PreAuthenticatedToken(
            $username,
            $password,
            $providerKey,
            ['API_USER']
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }
}

