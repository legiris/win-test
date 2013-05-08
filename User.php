<?php
/**
 * Trida pro spravu 1 uzivatele
 */
class User
{
    /**
     * @var int
     */
    protected $id = null;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    function __construct($id = null)
    {
        if ($id != null) {
            $this->find($id);
        }
    }

    /**
     * Nacteni uzivatele z databaze
     * @param int $id
     */
    public function find($id)
    {
        $sqlUser = mysql_query('
            SELECT
                id, firstname, lastname
            FROM
                users
            WHERE
                id = ' . $id . '
        ');

        $user = mysql_fetch_assoc($sqlUser);
        mysql_free_result($sqlUser);

        $this->id = (int) $user['id'];
        $this->setFirstname($user['firstname']);
        $this->setLastname($user['lastname']);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string:
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Ulozi data o uzivateli do DB
     */
    public function save()
    {
        if ($this->id != null) {
            mysql_query('
                UPDATE
                    users
                SET
                    firstname = "' . $this->getFirstname() . '",
                    lastname = "' . $this->getLastname() . '"
                WHERE
                    id = ' . $this->getId() . '
            ');
        } else {
            mysql_query('
                INSERT INTO
                    users (firstname, lastname)
                VALUES
                    ("' . $this->getFirstname() . '", "' . $this->getLastname() . '")
            ');
        }
    }

    /**
     * Smaze uzivatele z DB
     */
    public function delete()
    {
        if ($this->id != null) {
            mysql_query('
                DELETE FROM
                    users
                WHERE
                    id = ' . $this->getId() . '
            ');
        }
    }

    /**
     * Nastavi data u uzivatele
     * @param array $data
     */
    public function setData($data)
    {
        $this->id = (int) $data['id'];
        $this->setFirstname($data['firstname']);
        $this->setLastname($data['lastname']);
    }
}