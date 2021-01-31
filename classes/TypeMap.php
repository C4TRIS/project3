<?php
    class TypeMap extends BaseMap {
        public function arrTypes() {
            $res = $this->db->query("SELECT type_id AS id, name AS value FROM type");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT type_id, name FROM type WHERE type_id = $id");
                return $res->fetchObject("Type");
            }
            return new Type();
        }

        public function save(Type $type) {
            if ($type->validate()) {
                if ($type->type_id == 0) {
                    return $this->insert($type);
                } else {
                    return $this->update($type);
                }
            }
            return false;
        }

        private function insert(Type $type) {
            $name = $this->db->quote($type->name);
            if ($this->db->exec("INSERT INTO type(name) VALUES($name)") == 1) {
                $type->type_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Type $type) {
            $name = $this->db->quote($type->name);
            if ( $this->db->exec("UPDATE type SET name = $name WHERE type_id = ".$type->type_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM type WHERE type_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT type.type_id, type.name FROM type ORDER BY name LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findInstances($id) {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM machine INNER JOIN model ON machine.model_id=model.model_id INNER JOIN type ON model.type_id=type.type_id WHERE type.type_id=$id");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM type");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT type.type_id, type.name FROM type WHERE type_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsTypeById($id) {
            $res = $this->db->query("SELECT type_id FROM type WHERE type_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>