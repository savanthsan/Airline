<?php
class Admin extends User {
    public function __construct($db) {
        parent::__construct($db);
        $this->table_name = 'admin';
        $this->id_field = 'admin_id';
    }
}
?>
