<?php
namespace NoobDB\Entities;
/**
 *  @table(name="noobs")
 *  @Entity
 */
class Noobs {

    /**
     * @id
     * @Column(type="integer")
     * @generatedValue
     */
    private $noob_id;

    /** 
     *  @Column(type="string", length="100")
     */
    private $noob_nick;

    /** 
     *  @Column(type="string", length="100")
     */
    private $noob_descriptions;

    /**
     * @OneToOne(targetEntity="Users")
     * @JoinColumn(name="user_id_fk", referencedColumnName="user_id")
    */
    private $user;

    /**
     *  @Column(type="string", length="100")
     */
    private $noob_server;

    /** 
     *  @Column(type="string", length="100")
     */
    private $noob_map;

    /**
     *  @Column(type="datetime")
     */
    private $noob_dateplaying;

    /**
     *  @Column(type="datetime")
     */
    private $noob_dateadd;

    /**
     * @OneToOne(targetEntity="Games")
     * @JoinColumn(name="game_id_fk", referencedColumnName="game_id")
    */
    private $game;

    /**
     * @OneToOne(targetEntity="Country")
     * @JoinColumn(name="country_iso_fk", referencedColumnName="country_iso")
    */
    private $country;

    /**
     *  @Column(name="noob_status", type="string", length="1")
     */
    private $status;

    /**
     * @ManyToMany(targetEntity="Guilts")
     * @JoinTable(name="noobs_to_guilts",
     *      joinColumns={@JoinColumn(name="noob_id_fk", referencedColumnName="noob_id")},
     *      inverseJoinColumns={@JoinColumn(name="guilt_id_fk", referencedColumnName="guilt_id")}
     *      )
     */
    private $guilts;

    /**
     * @OneToMany(targetEntity="Screenshots", mappedBy="noob", cascade={"persist"})
     */
    private $screenshots;

    /**
     * @OneToOne(targetEntity="Votes")
     * @JoinColumn(name="noob_id", referencedColumnName="noob_id_fk")
    */
    private $vote;

    /**
     * @OneToMany(targetEntity="Comments", mappedBy="noob")
     */
    private $comments;

    /**
     * @OneToMany(targetEntity="NAccounts", mappedBy="noob")
     */
    private $accounts;

    /**
     * @OneToMany(targetEntity="ChangeNick", mappedBy="noob")
     */
    private $nickChanges;

    public function __construct() {
        $this->guilts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNoob_id() {
        return $this->noob_id;
    }

    public function setNoob_id($noob_id) {
        $this->noob_id = $noob_id;
    }

    public function getNoob_nick() {
        return $this->noob_nick;
    }

    public function setNoob_nick($noob_nick) {
        $this->noob_nick = $noob_nick;
    }

    public function getNoob_descriptions() {
        return $this->noob_descriptions;
    }

    public function setNoob_descriptions($noob_descriptions) {
        $this->noob_descriptions = $noob_descriptions;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(Users $user) {
        $this->user = $user;
    }

    public function getNoob_server() {
        return $this->noob_server;
    }

    public function setNoob_server($noob_server) {
        $this->noob_server = $noob_server;
    }

    public function getNoob_map() {
        return $this->noob_map;
    }

    public function setNoob_map($noob_map) {
        $this->noob_map = $noob_map;
    }

    public function getNoob_dateadd() {
        return $this->noob_dateadd;
    }

    public function setNoob_dateadd($noob_dateadd) {
        $this->noob_dateadd = $noob_dateadd;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame(Games $game) {
        $this->game = $game;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry(Country $country) {
        $this->country = $country;
    }

    public function getNoob_dateplaying() {
        return $this->noob_dateplaying;
    }

    public function setNoob_dateplaying($noob_dateplaying) {
        $this->noob_dateplaying = $noob_dateplaying;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getGuilts() {
        return $this->guilts;
    }

    public function setGuilts(Guilts $guilts) {
        $this->guilts[] = $guilts;
    }

    public function getScreenshots() {
        return $this->screenshots;
    }

    public function setScreenshots(Screenshots $screenshots) {
        $this->screenshots[] = $screenshots;
    }

    public function getVote() {
        return $this->vote;
    }

    public function setVote(Votes $vote) {
        $this->vote = $vote;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setComments($comments) {
        $this->comments[] = $comments;
    }

    public function getAccounts() {
        return $this->accounts;
    }

    public function setAccounts($accounts) {
        $this->accounts[] = $accounts;
    }

    public function getNickChanges() {
        return $this->nickChanges;
    }

    public function setNickChanges($nickChanges) {
        $this->nickChanges[] = $nickChanges;
    }
}
?>
