<?php

namespace Models;

/**
 * User model.
 * 
 * @Entity
 * @Table(name="users")
 * 
 * @author     Patrik Votoček
 * @package    Models
 * 
 * @property-read string $username
 * @property string $password
 * @property string $email
 */
class UserEntity extends BaseEntity
{
	const PASSWORD_DELIMITER = "$";

	/**
	 * @Column(length=64, unique=true)
	 * @var string
	 */
	private $username;
	/**
	 * @Column(length=282, nullable=false)
	 * @var string
	 */
	private $password;
	
	/**
	 * @param string $username
	 * @param string $password
	 * @throws \InvalidArgumentException
	 */
	public function __construct($username, $password)
	{
		$this->setUsername($username);
		$this->setPassword($password);
	}
	
	/**
	 * @return string $username
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	/**
	 * @param string $username
	 * @return UserEntity
	 * @throws \InvalidArgumentException
	 */
	private function setUsername($username)
	{
		if (strlen($username) > 64) {
			throw new \InvalidArgumentException("Username max 64 chars length");
		} elseif (!\Nette\String::match($username, "/[a-z0-9-_]*/i")) {
			throw new \InvalidArgumentException("Username contains only alphanumeric string widht - and _");
		} else {
			$user = \Nette\Environment::getService('Doctrine\ORM\EntityManager')
				->getRepository(get_called_class())
				->findOneByUsername($username);
			if (!empty($user)) {
				throw new \InvalidArgumentException("User width username '$username' is exist");
			}
		}
		
		$this->username = $username;
		return $this;
	}
	
	/**
	 * @param bool $string return as string or assoc. array
	 * @return string
	 */
	public function getPassword($string = TRUE)
	{
		if ($string)
			return $this->password;
		
		list($algo, $salt, $hash) = explode(self::PASSWORD_DELIMITER, $this->password);
		return array('algo' => $algo, 'salt' => $salt, 'hash' => $hash);
	}

	/**
	 * @param string $password plaitext password
	 * @param string $algo name of selected hashing algorithm
	 * @return UserEntity
	 */
	public function setPassword($password, $algo = "sha256")
	{
		$salt = self::getRandomString(10);
		$this->password = $algo . self::PASSWORD_DELIMITER
			 . $salt . self::PASSWORD_DELIMITER
			 . hash($algo, $salt . $password);
		return $this;
	}

	/**
	 * @param string $password plaintext password
	 * @return bool
	 */
	public function verifyPassword($password)
	{
		$data = $this->getPassword(FALSE);
		if (hash($data['algo'], $data['salt'] . $password) == $data['hash']) {
			return TRUE;
		}

		return FALSE;
	}
	
	/**
	 * Get random generated string
	 *
	 * @param int $length
	 * @param string $base
	 * @return string
	 */
	protected static function getRandomString($length, $base = "abcdefghjkmnpqrstwxyz0123456789")
	{
	    $max = strlen($base) - 1;
	    $key = "";
	    mt_srand((double) microtime() * 1000000);
	    while (strlen($key) < $length) {
	        $key .= $base[mt_rand(0, $max)];
	    }

	    return $key;
	}
}