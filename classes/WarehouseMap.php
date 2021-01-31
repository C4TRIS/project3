<?php
    class WarehouseMap extends BaseMap {
        public function arrWarehouses() {
            $res = $this->db->query("SELECT warehouse_id AS id, name AS value FROM warehouse");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT warehouse_id, name, company_id, address, square FROM warehouse WHERE warehouse_id = $id");
                return $res->fetchObject("Warehouse");
            }
            return new Warehouse();
        }

        public function save(Warehouse $warehouse) {
            if ($warehouse->validate()) {
                if ($warehouse->warehouse_id == 0) {
                    return $this->insert($warehouse);
                } else {
                    return $this->update($warehouse);
                }
            }
            return false;
        }

        private function insert(Warehouse $warehouse) {
            $name = $this->db->quote($warehouse->name);
            $address = $this->db->quote($warehouse->address);
            if ($this->db->exec("INSERT INTO warehouse(name, company_id, address, square) VALUES($name, $warehouse->company_id, $address, $warehouse->square)") == 1) {
                $warehouse->warehouse_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Warehouse $warehouse) {
            $name = $this->db->quote($warehouse->name);
            $address = $this->db->quote($warehouse->address);
            if ( $this->db->exec("UPDATE warehouse SET name = $name, company_id = $warehouse->company_id, address = $address, square = $warehouse->square WHERE warehouse_id = ".$warehouse->warehouse_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM warehouse WHERE warehouse_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT warehouse.warehouse_id, warehouse.name, company.name AS company, warehouse.address, warehouse.square FROM warehouse INNER JOIN company ON warehouse.company_id=company.company_id LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM warehouse");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT warehouse.warehouse_id, warehouse.name, company.name AS company, warehouse.address, warehouse.square FROM warehouse INNER JOIN company ON warehouse.company_id=company.company_id WHERE warehouse_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsWarehouseByCompanyId($id) {
            $res = $this->db->query("SELECT warehouse_id FROM warehouse WHERE company_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>