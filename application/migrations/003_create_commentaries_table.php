<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_commentaries_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field('id');

        $this->dbforge->add_field('text text');
        $this->dbforge->add_field('leave_at datetime');

        $this->dbforge->add_field('article_id int(9)');
        $this->dbforge->add_field('constraint foreign key (article_id) references articles(id)
            on delete cascade');

        $this->dbforge->add_field('user_id int(9)');
        $this->dbforge->add_field('constraint foreign key (user_id) references users(id) 
            on delete cascade');
                
        $this->dbforge->create_table('commentaries');
    }

    public function down()
    {
        $this->dbforge->drop_table('commentaries');
    }
}
