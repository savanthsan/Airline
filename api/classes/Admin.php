<?php
class Admin extends User {
    private $admin_id;
    private $username;

    public function __construct($db) {
        parent::__construct($db);
        $this->table_name = 'admin';
        $this->id_field = 'admin_id';
    }

    public function getAdminId() { return $this->admin_id; }
    public function getUsername() { return $this->username; }
}
?>
