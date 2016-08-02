<?php

include_once 'Truncatable.php';

class User extends CI_Model
{
	use Truncatable;

	/**
	 * @var string
	 */
	private $table = 'users';

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * @param  array  $credentials
     * @return integer
     */
    public function register(array $credentials)
    {
    	$this->db->insert($this->table, $credentials);

        return $this->db->insert_id();  // fine ?
    }

    /**
     * @param  integer $user
     * @return object
     */
    public function getById($user)
    {
        return $this->db->where('id', $user)
            ->from($this->table)
            ->get()
            ->row();
    }

    /**
     * @param  string $email
     * @return object
     */
    public function getByEmail($email)
    {
        return $this->db->where('email', $email)
            ->from($this->table)
            ->get()
            ->row();
    }
}
