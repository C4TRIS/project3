<?php
    class WaybillMap extends BaseMap {

        public function save(Waybill $waybill) {
            $date_recieved = $this->db->quote($waybill->date_recieved);
            if ($this->db->exec("INSERT INTO waybill(date_recieved, warehouse_id, user_id, part_id, price) VALUES($date_recieved, $waybill->warehouse_id, $waybill->user_id, $waybill->part_id, $waybill->price)") == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM waybill WHERE waybill_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT waybill_id, warehouse, user_id, date_recieved, price, part_id FROM waybill LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT waybill_id, warehouse, user_id, date_recieved, price, part_id FROM waybill WHERE waybill_id=$id");
                return $res->fetchObject('Waybill');
            }
            return false;
        }

        public function findWorkers($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname, ' ', user.firstname,' ', user.patronymic) AS full_name,"
                                    . " COUNT(waybill.user_id) AS count_waybill "
                                    . "FROM user INNER JOIN worker ON user.user_id=worker.user_id "
                                    . "LEFT OUTER JOIN waybill ON worker.user_id=waybill.user_id "
                                    . "GROUP BY user.user_id "
                                    . "LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT waybill.waybill_id, waybill.user_id, waybill.price, part.name AS part, waybill.date_recieved, warehouse.name AS warehouse, CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) AS full_name FROM waybill INNER JOIN part ON waybill.part_id=part.part_id INNER JOIN warehouse ON waybill.warehouse_id=warehouse.warehouse_id INNER JOIN user ON waybill.user_id=user.user_id WHERE waybill_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsWaybillByWarehouseId($id) {
            $res = $this->db->query("SELECT waybill_id FROM waybill WHERE warehouse_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsWaybillByUserId($id) {
            $res = $this->db->query("SELECT waybill_id FROM waybill WHERE user_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsWaybillByPartId($id) {
            $res = $this->db->query("SELECT waybill_id FROM waybill WHERE part_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function findByWorkerId($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT waybill.waybill_id, part.name AS part, warehouse.name AS warehouse, waybill.date_recieved, waybill.price FROM waybill INNER JOIN part ON waybill.part_id=part.part_id INNER JOIN warehouse ON waybill.warehouse_id=warehouse.warehouse_id WHERE user_id = $id");
                return $res->fetchAll(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function findWaybills($id, $date) {
            $date = $this->db->quote($date.'-01');
            $res = $this->db->query("SELECT DAY(waybill.date_recieved) as day, waybill.waybill_id, part.name AS part, warehouse.name AS warehouse, waybill.date_recieved FROM waybill INNER JOIN part ON waybill.part_id=part.part_id INNER JOIN warehouse ON waybill.warehouse_id=warehouse.warehouse_id WHERE waybill.warehouse_id=$id AND MONTH(date_recieved) = MONTH($date) ORDER BY DAY(waybill.date_recieved)");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>