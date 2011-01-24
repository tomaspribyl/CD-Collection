<?php

use Nette\Application\AppForm,
	Nette\Forms\Form;



class DashboardPresenter extends BasePresenter
{

	protected function startup()
	{
		// user authentication
		if (!$this->user->isLoggedIn()) {
			if ($this->user->logoutReason === Nette\Web\User::INACTIVITY) {
				$this->flashMessage('You have been logged out due to inactivity. Please login again.');
			}
			$backlink = $this->application->storeRequest();
			$this->redirect('Auth:login', array('backlink' => $backlink));
		}

		parent::startup();
	}



	/********************* view default *********************/



	public function renderDefault()
	{
		try {
			$this->template->albums = $this->em->getRepository('Models\AlbumEntity')
				->createQueryBuilder('album')
				->join('album.artist', 'artist')->orderBy('artist.name')
				->getQuery()->setMaxResults(10)->getResult();
        $qb = $this->em->createQueryBuilder();
        $qb->select("n, g");
        $qb->from("NoobDB\Entities\Noobs", "n");
        $qb->leftjoin("n.guilts", "g")->setMaxResults(24);
        $q = $qb->getQuery()
                ->setHydrationMode(4);
        Nette\Debug::dump($q->getArrayResult());
        //$q->useQueryCache(true);

		} catch (\Doctrine\ORM\NoResultException $e) {
			$this->template->albums = array();
		}
	}



	/********************* views add & edit *********************/



	public function renderAdd()
	{
		$this['albumForm-save']->caption = 'Add';
	}



	public function renderEdit($id = 0)
	{
		$form = $this['albumForm'];
		if (!$form->isSubmitted()) {
			$album = $this->em->find('Models\AlbumEntity', $id);
			if (!$album) {
				throw new Nette\Application\BadRequestException('Record not found');
			}
			$form->setDefaults(array('artist' => $album->artist->name, 'title' => $album->title));
		}
	}



	/********************* view delete *********************/



	public function renderDelete($id = 0)
	{
		$this->template->album = $this->em->find('Models\AlbumEntity', $id);
		if (!$this->template->album) {
			throw new Nette\Application\BadRequestException('Record not found');
		}
	}



	/********************* action logout *********************/



	public function actionLogout()
	{
		$this->user->logout();
		$this->flashMessage('You have been logged off.');
		$this->redirect('Auth:login');
	}



	/********************* component factories *********************/



	/**
	 * Album edit form component factory.
	 * @param string $name
	 */
	protected function createComponentAlbumForm($name)
	{
		$form = new AppForm($this, $name);
		
		$form->addText('artist', 'Artist:')
			->addRule(Form::FILLED, 'Please enter an artist.');

		$form->addText('title', 'Title:')
			->addRule(Form::FILLED, 'Please enter a title.');

		$form->addSubmit('save', 'Save')->setAttribute('class', 'default');
		$form->addSubmit('cancel', 'Cancel')->setValidationScope(NULL);
		
		$form->onSubmit[] = callback($this, 'albumFormSubmitted');

		$form->addProtection('Please submit this form again (security token has expired).');
	}



	public function albumFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			
			$artist = $this->em->getRepository('Models\ArtistEntity')
				->findOneByName($form['artist']->value);
			if (!$artist) {
				$artist = new Models\ArtistEntity($form['artist']->value);
				$this->em->persist($artist);
			}
			
			if ($id > 0) {
				$album = $this->em->find('Models\AlbumEntity', $id);
				$album->setArtist($artist)->title = $form['title']->value;
				$this->flashMessage('The album has been updated.');
			} else {
				$album = new Models\AlbumEntity($artist, $form['title']->value);
				$this->em->persist($album);
				$this->flashMessage('The album has been added.');
			}
		}
		
		$this->em->flush();
		$this->redirect('default');
	}



	/**
	 * Album delete form component factory.
	 * @return string $name
	 */
	protected function createComponentDeleteForm($name)
	{
		$form = new AppForm($this, $name);
		
		$form->addSubmit('cancel', 'Cancel');
		$form->addSubmit('delete', 'Delete')->setAttribute('class', 'default');
		
		$form->onSubmit[] = callback($this, 'deleteFormSubmitted');
		
		$form->addProtection('Please submit this form again (security token has expired).');
	}



	public function deleteFormSubmitted(AppForm $form)
	{
		if ($form['delete']->isSubmittedBy()) {
			$album = $this->em->find('Models\AlbumEntity', $this->getParam('id'));
			$this->em->remove($album);
			$this->flashMessage('Album has been deleted.');
		}

		$this->em->flush();
		$this->redirect('default');
	}

}
