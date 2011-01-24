<?php

/**
 * User authenticator.
 * 
 * @author     Patrik Votoček
 */
class Authenticator implements \Nette\Security\IAuthenticator
{
	/**
	 * Performs an authentication
	 * @param  array
	 * @return IIdentity
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		$username = strtolower($credentials[self::USERNAME]);
		$password = strtolower($credentials[self::PASSWORD]);

		$user = Nette\Environment::getService('Doctrine\ORM\EntityManager')
			->getRepository('Models\UserEntity')
			->findOneByUsername($username);

		if (!$user) {
			throw new \Nette\Security\AuthenticationException("User '$username' not found.", self::IDENTITY_NOT_FOUND);
		}

		if (!$user->verifyPassword($password)) {
			throw new \Nette\Security\AuthenticationException("Invalid password.", self::INVALID_CREDENTIAL);
		}

		return new Nette\Security\Identity($user->id, NULL, $user);
	}
}