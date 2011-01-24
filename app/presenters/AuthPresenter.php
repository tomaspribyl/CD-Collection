<?php

use Nette\Application\AppForm,
	Nette\Forms\Form,
	Nette\Security\AuthenticationException;



class AuthPresenter extends BasePresenter
{
	/** @persistent */
	public $backlink = '';



	public function startup()
	{
		parent::startup();
		$this->session->start(); // required by $form->addProtection()
	}



	/********************* component factories *********************/



	/**
	 * Login form component factory.
	 * @param string $name
	 */
	protected function createComponentLoginForm($name)
	{
		$form = new AppForm($this, $name);
		$form->addText('username', 'Username:')
			->addRule(Form::FILLED, 'Please provide a username.');

		$form->addPassword('password', 'Password:')
			->addRule(Form::FILLED, 'Please provide a password.');

		$form->addSubmit('login', 'Login');

		$form->addProtection('Please submit this form again (security token has expired or you have disabled cookies).');

		$form->onSubmit[] = callback($this, 'loginFormSubmitted');
	}



	public function loginFormSubmitted($form)
	{
		try {
			$this->user->login($form['username']->value, $form['password']->value);
			$this->application->restoreRequest($this->backlink);
			$this->redirect('Dashboard:');

		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
