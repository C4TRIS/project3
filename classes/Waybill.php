<?php
    class Waybill extends Table {

        public $waybill_id = 0;
        public $warehouse_id = 0;
        public $date_recieved = 0;
        public $part_id = 0;
        public $price = 0;
        public $user_id = 0;

        public function validate() {
            if(!empty($this->warehouse_id) &&
                !empty($this->date_recieved) &&
                !empty($this->part_id) &&
                !empty($this->price) &&
                !empty($this->user_id)) {
                return true;
            }
            return false;
        }
    }
?>