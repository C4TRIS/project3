<?php
    class Warehouse extends Table {

        public $warehouse_id = 0;
        public $name = '';
        public $company_id = 0;
        public $address = '';
        public $square = 0;

        public function validate() {
            if(!empty($this->name) &&
                !empty($this->address) &&
                !empty($this->square) &&
                !empty($this->company_id)) {
                return true;
            }
            return false;
        }
    }
?>