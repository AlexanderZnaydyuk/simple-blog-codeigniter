<?php

include_once 'Truncatable.php';

class Comment extends CI_Model
{
	use Truncatable;

	/**
	 * @var string
	 */
	private $table = 'commentaries';

    public function __construct()
    {
        $this->load->database();
    }

    public function leave(array $comment)
    {
    	return $this->db->insert($this->table, $comment);
    }
}
