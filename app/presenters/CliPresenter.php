<?php

use Nette\Environment,
	Nette\Debug;

/**
 * CLI presenter
 *
 * @author     Patrik Votoček
 */
class CliPresenter extends BasePresenter
{
	protected function startup()
	{
		parent::startup();
		Environment::getCache('Doctrine')->clean(array('tags' => array("doctrine")));
	}

	public function actionCreateSchema($dump = FALSE)
	{
		$sTools = new \Doctrine\ORM\Tools\SchemaTool($this->em);
		
		echo "Loading metadata..." . PHP_EOL;
		
		try {
			$metadatas = $this->em->getMetadataFactory()->getAllMetadata();
			echo "DONE" . PHP_EOL;
		} catch (\Exception $e) {
			Debug::log($e);
			echo "Error: {$e->getMessage()}";
		}
		
		echo "Generating schema..." . PHP_EOL;
		
		if ($dump === TRUE)
			echo implode(';' . PHP_EOL, $sTools->getCreateSchemaSql($metadatas)) . PHP_EOL;
		elseif ($dump) {
			file_put_contents(((substr($dump, 0, 1) == "/" || substr($dump, 1, 1) == ":") ? "" : (WWW_DIR . "/")) . $dump,
				implode(';' . PHP_EOL, $sTools->getCreateSchemaSql($metadatas)));
		} else {
			try {
				$sTools->updateSchema($metadatas);
				echo "DONE" . PHP_EOL;
			} catch (\Exception $e) {
				Debug::log($e);
				echo "Error: {$e->getMessage()}";
			}
		}
		
		echo "Inserting demo data..." . PHP_EOL;
		
		try {
			// default artists
			$artist1 = new Models\ArtistEntity("Suzanne Vega");
			$artist2 = new Models\ArtistEntity("Moby");
			$this->em->persist($artist1);
			$this->em->persist($artist2);
			// default albums
			$album1 = new Models\AlbumEntity($artist1, "Beauty & Crime");
			$album2 = new Models\AlbumEntity($artist2, "Play");
			$this->em->persist($album1);
			$this->em->persist($album2);
			// default user
			$user = new Models\UserEntity("demo", "xxx");
			$this->em->persist($user);
			
			$this->em->flush();
			
			echo "DONE" . PHP_EOL;
		} catch (\Exception $e) {
			Debug::log($e);
			echo "Error: {$e->getMessage()}";
		}
		
		$this->terminate();
	}
}