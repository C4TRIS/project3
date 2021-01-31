<?php
    class Model extends Table {

        public $model_id = 0;
        public $name = '';
        public $type_id = 0;

        public function validate() {
            if(!empty($this->name) &&
                !empty($this->type_id)) {
                return true;
            }
            return false;
        }
    }
?>