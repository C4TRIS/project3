<?php
    class Part extends Table {

        public $part_id = 0;
        public $name = '';
        public $model_id = 0;

        public function validate() {
            if(!empty($this->name) &&
                !empty($this->model_id)) {
                return true;
            }
            return false;
        }
    }
?>