<?php
    class Machine extends Table {

        public $machine_id = 0;
        public $model_id = 0;
        public $date_started = '';
        public $lifetime = 0;
        public $date_writeoff = null;
        public $user_id = 0;
        public $company_id = 0;

        public function validate() {
            if(!empty($this->date_started) &&
                !empty($this->model_id) &&
                !empty($this->lifetime) &&
                !empty($this->user_id) &&
                !empty($this->company_id)) {
                return true;
            }
            return false;
        }
    }
?>