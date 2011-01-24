<?php

namespace Models;

/**
 * Albums model.
 * 
 * @Entity
 * @Table(name="albums")
 * 
 * @author     Patrik Votoček
 * @package    Models
 * 
 * @property Artist $artist
 * @property string $title
 */
class AlbumEntity extends BaseEntity
{
	/**
	 * @ManyToOne(targetEntity="ArtistEntity", inversedBy="albums")
         * @JoinColumn(name="artist_id", referencedColumnName="id"))
	 * @var ArtistEntity
	 */
	private $artist;
	/**
	 * @Column(length=128)
	 * @var string
	 */
	private $title;
	
	/**
	 * @param ArtistEntity $artist
	 * @param string $title
	 * @throws \InvalidArgumentException
	 */
	public function __construct(ArtistEntity $artist, $title)
	{
		$this->artist = $artist;
		$this->setTitle($title);
	}
	
	/**
	 * @return ArtistEntity
	 */
	public function getArtist()
	{
		return $this->artist;
	}
	
	/**
	 * @param ArtistEntity $artist
	 * @return AlbumEntity
	 */
	public function setArtist(ArtistEntity $artist)
	{
		$this->artist = $artist;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @param string $title
	 * @return AlbumEntity
	 * @throws \InvalidArgumentException
	 */
	public function setTitle($title)
	{
		if (strlen($title) > 128) {
			throw new \InvalidArgumentException("Title max 128 chars length");
		}
		
		$this->title = $title;
		return $this;
	}
}