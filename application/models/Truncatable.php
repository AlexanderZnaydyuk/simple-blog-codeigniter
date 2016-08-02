<?php

trait Truncatable
{
    /**
     * Truncate the table
     * @return null
     */
    public function truncate()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $this->db->truncate($this->table);
        
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }
}
