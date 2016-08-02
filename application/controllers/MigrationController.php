<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MigrationController extends CI_Controller
{
    /**
     * Migrate database and seed test data
     * @return null
     */
    public function migrate()
    {
        $this->load->library('migration');
        $this->load->library('seeder');

        if ($this->migration->current() === false) {
            show_error($this->migration->error_string());
        }
        
        $this->seeder->seed();
    }
}
