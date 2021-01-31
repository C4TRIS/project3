<?php
    class modelMap extends BaseMap {
        public function arrModels() {
            $res = $this->db->query("SELECT model_id AS id, name AS value FROM model ORDER BY name");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT model_id, name, type_id FROM model WHERE model_id = $id");
                return $res->fetchObject("Model");
            }
            return new Model();
        }

        public function save(Model $model) {
            if ($model->validate()) {
                if ($model->model_id == 0) {
                    return $this->insert($model);
                } else {
                    return $this->update($model);
                }
            }
            return false;
        }

        private function insert(Model $model) {
            $name = $this->db->quote($model->name);
            if ($this->db->exec("INSERT INTO model(name, type_id) VALUES($name, $model->type_id)") == 1) {
                $model->model_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Model $model) {
            $name = $this->db->quote($model->name);
            if ( $this->db->exec("UPDATE model SET name = $name, type_id = $model->type_id WHERE model_id = ".$model->model_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM model WHERE model_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT model.model_id, model.name, type.name AS type FROM model INNER JOIN type ON model.type_id=type.type_id ORDER BY name LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM model");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT model.model_id, model.name, type.name AS type FROM model INNER JOIN type ON model.type_id=type.type_id WHERE model_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function findInstances($id) {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM machine INNER JOIN model ON machine.model_id=model.model_id INNER JOIN type ON model.type_id=type.type_id WHERE type.type_id=$id");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function existsModelById($id) {
            $res = $this->db->query("SELECT model_id FROM model WHERE model_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsModelByTypelId($id) {
            $res = $this->db->query("SELECT model_id FROM model WHERE type_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>