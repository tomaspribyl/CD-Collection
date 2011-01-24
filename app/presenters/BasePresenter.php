<?php

/**
 * @author     Patrik Votoček
 * 
 * @property-read \Doctrine\ORM\EntityManager $em
 */
abstract class BasePresenter extends Nette\Application\Presenter
{
	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEm()
	{
		return Nette\Environment::getService('Doctrine\ORM\EntityManager');
	}
}
