<?php
namespace NoobDB\Entities;
/** @entity(repositoryClass="NoobDB\Model\GuiltsRepository")
 *  @table(name="guilts")
 */
class Guilts {

    /**
     * @id
     * @Column(type="integer")
     * @generatedValue
     */
    private $guilt_id;

    /**
     *
     *  @Column(length="50") */
    private $guilt_title;

    /**
     * @Column(type="string", length="255")
     */
    private $guilt_descriptions;

    public function getId() {
        return $this->guilt_id;
    }

    public function setId($guilt_id) {
        $this->guilt_id = $guilt_id;
    }

    public function getTitle() {
        return $this->guilt_title;
    }

    public function setTitle($guilt_title) {
        $this->guilt_title = $guilt_title;
    }

    public function getDescriptions() {
        return $this->guilt_descriptions;
    }

    public function setDescriptions($guilt_descriptions) {
        $this->guilt_descriptions = $guilt_descriptions;
    }


}