<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_articles_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field('id');

        $this->dbforge->add_field('title varchar(255)');
        $this->dbforge->add_field('image varchar(255)');
        $this->dbforge->add_field('text text');
        $this->dbforge->add_field('published_at datetime');

        $this->dbforge->add_field('user_id int(9)');
        $this->dbforge->add_field('constraint foreign key (user_id) references users(id) 
            on delete cascade');

        $this->dbforge->create_table('articles');
    }

    public function down()
    {
        $this->dbforge->drop_table('articles');
    }
}
