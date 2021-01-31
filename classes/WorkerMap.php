<?php
    class WorkerMap extends BaseMap {
        public function arrWorkers() {
            $res = $this->db->query("SELECT worker.user_id AS id, CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) AS value FROM worker INNER JOIN user ON worker.user_id=user.user_id");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT user_id FROM worker WHERE user_id = $id");
                $worker = $res->fetchObject("Worker");
                if ($worker) {
                    return $worker;
                }
            }
            return new Worker();
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT worker.user_id, user.username, CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) AS full_name, user.birthday, "
                                    . " role.name AS roleName, role.sys_name AS role FROM worker INNER JOIN user on worker.user_id=user.user_id"
                                    . " INNER JOIN role ON user.role_id=role.role_id LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM worker");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function save(User $user, Worker $worker) {
            if ($user->validate() && $worker->validate() && (new UserMap())->save($user)) {
                if ($worker->user_id == 0) {
                    $worker->user_id = $user->user_id;
                    return $this->insert($worker);
                } else {
                    return $this->update($worker);
                }
            }
            return false;
        }

        private function insert(Worker $worker) {
            if ($this->db->exec("INSERT INTO worker(user_id) VALUES($worker->user_id)") == 1) {
                return true;
            }
            return false;
        }

        private function update(Worker $worker) {
            return true;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM worker WHERE user_id=$id") == 1 && (new UserMap())->delete($id) == 1) {
                return true;
            }
            return false;
        }

        public function findProfileById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT worker.user_id, user.username, user.firstname, user.patronymic, user.lastname, user.birthday, role.name AS role FROM worker INNER JOIN user on worker.user_id=user.user_id INNER JOIN role on user.role_id=role.role_id WHERE worker.user_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
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

        public function existsWaybillByUserId($id) {
            $res = $this->db->query("SELECT waybill_id FROM waybill WHERE user_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>