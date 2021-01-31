<?php
    class Worker extends Table {

        public $user_id = 0;

        public function validate() {
            return true;
        }

        public function validateWorker() {
            if (!empty($this->user_id)) {
                return true;
            }
            return false;
        }
    }
?>