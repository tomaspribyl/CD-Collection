<?php
namespace Models;

/**
 * Base model entity
 *
 * @MappedSuperclass
 * 
 * @author     Patrik Votoček
 * @package    Models
 * 
 * @property-read int $id
 */
abstract class BaseEntity extends \Nette\Object
{
	/**
	 * @Id
	 * @Column(type = "integer")
	 * @GeneratedValue
	 * @var int
	 */
	protected $id;

	/**
	 * @return int
	 */
	final public function getId()
	{
		return $this->id;
	}
}