<?php

namespace Models;

/**
 * Albums model.
 * 
 * @Entity
 * @Table(name="artists")
 * 
 * @author     Patrik Votoček
 * @package    Models
 * 
 * @property string $name
 * @property-read \Doctrine\Common\Collections\ArrayCollection $albums
 */
class ArtistEntity extends BaseEntity
{
	/**
	 * @Column(length=128)
	 * @var string
	 */
	protected $name;
	/**
	 * @OneToMany(targetEntity="AlbumEntity", mappedBy="artist", cascade={"persist", "remove"})
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	private $albums;
	
	/**
	 * @param string $name
	 * @throws \InvalidArgumentException
	 */
	public function __construct($name)
	{
		$this->setName($name);
		$this->albums = new \Doctrine\Common\Collections\ArrayCollection;
	}
	
	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getAlbums()
	{
		return $this->albums;
	}
	
	/**
	 * @param AlbumEntity $album
	 * @return ArtistEntity
	 */
	public function addAlbum(AlbumEntity $album)
	{
		$this->albums->add($album);
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 * @return ArtistEntity
	 * @throws \InvalidArgumentException
	 */
	public function setName($name)
	{
		if (strlen($name) > 128) {
			throw new \InvalidArgumentException("Name max 128 chars length");
		}
		
		$this->name = $name;
		return $this;
	}
}