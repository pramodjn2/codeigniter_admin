<?php

class Migration_users extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
			'oauth_provider' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
			'oauth_uid' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
			'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
			'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
			'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
			'gender' => array(
                'type' => 'VARCHAR',
                'constraint' => 10
            ),
			'locale' => array(
                'type' => 'VARCHAR',
                'constraint' => 10
            ),
			'profile_url' => array(
                'type' => 'TEXT',
				'null' => TRUE
            ),
			'picture_url' => array(
                'type' => 'TEXT',
				'null' => TRUE
            ),
			'created' => array(
                'type' => 'DATETIME'
            ),
			'modified' => array(
                'type' => 'DATETIME'
            )
	    ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }

}