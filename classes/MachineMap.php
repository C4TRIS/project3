<?php
    class MachineMap extends BaseMap {
        public function arrMachines() {
            $res = $this->db->query("SELECT machine_id AS id, model.name AS value FROM machine INNER JOIN model ON machine.model_id=model.model_id");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT machine_id AS id, date_started, lifetime, date_writeoff, user_id, company_id, model.name AS model FROM machine INNER JOIN model ON machine.model_id=model.model_id WHERE machine_id = $id");
                return $res->fetchObject("Machine");
            }
            return new MachineMap();
        }

        public function save(Machine $machine) {
            if ($machine->validate()) {
                if ($machine->machine_id == 0) {
                    return $this->insert($machine);
                } else {
                    return $this->update($machine);
                }
            }
            return false;
        }

        private function insert(Machine $machine) {
            if (!empty($machine->date_writeoff)) {
                $date_writeoff = $this->db->quote($machine->date_writeoff);
            } else {
                $date_writeoff = "0000-00-00";
            }
            $date_started = $this->db->quote($machine->date_started);
            if ($this->db->exec("INSERT INTO machine(machine_id, lifetime, model_id, date_started, date_writeoff, user_id, company_id) VALUES($machine->machine_id, $machine->lifetime, $machine->model_id, $date_started, $date_writeoff, $machine->user_id, $machine->company_id)") == 1) {
                $machine->machine_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Machine $machine) {
            $date_started = $this->db->quote($machine->date_started);
            if (!empty($machine->date_writeoff)) {
                $date_writeoff = $this->db->quote($machine->date_writeoff);
            } else {
                $date_writeoff = "0000-00-00";
            }
            if ( $this->db->exec("UPDATE machine SET machine_id = $machine->machine_id, lifetime = $machine->lifetime, model_id = $machine->model_id, date_started = $date_started, date_writeoff = $date_writeoff, user_id = $machine->user_id, company_id = $machine->company_id WHERE machine_id = ".$machine->machine_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM machine WHERE machine_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT machine.machine_id, machine.lifetime, machine.date_started, model.name AS model, type.name AS type, machine.date_writeoff, CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) AS full_name, company.name AS company FROM machine INNER JOIN model ON machine.model_id=model.model_id INNER JOIN type ON model.type_id=type.type_id INNER JOIN user ON machine.user_id=user.user_id INNER JOIN company ON machine.company_id=company.company_id LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM machine");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT machine.machine_id, machine.lifetime, machine.date_started, model.name AS model, type.name AS type, machine.date_writeoff, CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) AS full_name, company.name AS company FROM machine INNER JOIN model ON machine.model_id=model.model_id INNER JOIN type ON model.type_id=type.type_id INNER JOIN user ON machine.user_id=user.user_id INNER JOIN company ON machine.company_id=company.company_id WHERE machine_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsMachineByModelId($id) {
            $res = $this->db->query("SELECT machine_id FROM machine WHERE model_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsMachineByUserId($id) {
            $res = $this->db->query("SELECT machine_id FROM machine WHERE user_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function existsMachineById($id) {
            $res = $this->db->query("SELECT machine_id FROM machine WHERE machine_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }

        public function findMachineById($id) {
            $res = $this->db->query("SELECT machine.company_id, machine.machine_id, machine.date_started, model.name AS model, company.name AS company FROM machine INNER JOIN model ON machine.model_id=model.model_id INNER JOIN company ON machine.company_id=company.company_id WHERE machine.model_id=$id AND (machine.date_writeoff = '0000-00-00' OR machine.date_writeoff > ".date("Ymd").")");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>