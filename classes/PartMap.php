<?php
    class PartMap extends BaseMap {
        public function arrParts() {
            $res = $this->db->query("SELECT part_id AS id, name AS value FROM part ORDER BY name");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT part_id, name, model_id FROM part WHERE part_id = $id");
                return $res->fetchObject("Part");
            }
            return new Part();
        }

        public function save(Part $part) {
            if ($part->validate()) {
                if ($part->part_id == 0) {
                    return $this->insert($part);
                } else {
                    return $this->update($part);
                }
            }
            return false;
        }

        private function insert(Part $part) {
            $name = $this->db->quote($part->name);
            if ($this->db->exec("INSERT INTO part(name, model_id) VALUES($name, $part->model_id)") == 1) {
                $part->part_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Part $part) {
            $name = $this->db->quote($part->name);
            if ( $this->db->exec("UPDATE part SET name = $name, model_id = $part->model_id WHERE part_id = ".$part->part_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM part WHERE part_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT part.part_id, part.name, model.name AS model FROM part INNER JOIN model ON part.model_id=model.model_id ORDER BY name LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM part");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT part.part_id, part.name, model.name AS model FROM part INNER JOIN model ON part.model_id=model.model_id WHERE part_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsWaybillByPartId($id) {
            $res = $this->db->query("SELECT part_id FROM waybill WHERE part_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsPartById($id) {
            $res = $this->db->query("SELECT part_id FROM part WHERE part_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsPartByModelId($id) {
            $res = $this->db->query("SELECT part_id FROM part WHERE model_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>