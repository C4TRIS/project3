<?php
    class User extends Table {

        public $user_id = 0;
        public $lastname = '';
        public $firstname = '';
        public $patronymic = null;
        public $username = null;
        public $password = null;
        public $birthday = null;

        public function validate() {
            if(!empty($this->firstname) &&
                !empty($this->lastname) &&
                !empty($this->username) &&
                !empty($this->patronymic) &&
                !empty($this->birthday) &&
                !empty($this->password)) {
                return true;
            }
            return false;
        }
    }
?>