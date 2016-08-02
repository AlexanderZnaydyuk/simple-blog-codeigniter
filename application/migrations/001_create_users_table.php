<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field('id');

        $this->dbforge->add_field('name varchar(100)');
        $this->dbforge->add_field('surname varchar(100)');

        $this->dbforge->add_field('email varchar(255)');
        $this->dbforge->add_field('password varchar(60)');
                
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
