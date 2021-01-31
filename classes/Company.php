<?php
    class Company extends Table {

        public $company_id = 0;
        public $name = '';

        public function validate() {
            if(!empty($this->name)) {
                return true;
            }
            return false;
        }
    }
?>