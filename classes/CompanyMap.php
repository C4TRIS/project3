<?php
    class CompanyMap extends BaseMap {
        public function arrCompanies() {
            $res = $this->db->query("SELECT company_id AS id, name AS value FROM company");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT company_id, name FROM company WHERE company_id = $id");
                return $res->fetchObject("Company");
            }
            return new Company();
        }

        public function save(Company $company) {
            if ($company->validate()) {
                if ($company->company_id == 0) {
                    return $this->insert($company);
                } else {
                    return $this->update($company);
                }
            }
            return false;
        }

        private function insert(Company $company) {
            $name = $this->db->quote($company->name);
            if ($this->db->exec("INSERT INTO company(name) VALUES($name)") == 1) {
                $company->company_id = $this->db->lastInsertId();
                return true;
            }
            return false;
        }

        private function update(Company $company) {
            $name = $this->db->quote($company->name);
            if ($this->db->exec("UPDATE company SET name = $name WHERE company_id = ".$company->company_id) == 1) {
                return true;
            }
            return false;
        }

        public function delete($id) {
            if ($this->db->exec("DELETE FROM company WHERE company_id=$id") == 1) {
                return true;
            }
            return false;
        }

        public function findAll($ofset = 0, $limit = 30) {
            $res = $this->db->query("SELECT company.company_id, company.name FROM company LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

        public function count() {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM company");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }

        public function findViewById($id = null) {
            if ($id) {
                $res = $this->db->query("SELECT company.company_id, company.name FROM company WHERE company_id = $id");
                return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
        }

        public function existsMachineByCompanyId($id) {
            $res = $this->db->query("SELECT machine_id FROM machine WHERE company_id = $id");
            if ($res->fetchColumn() > 0) {
                return true;
            }
            return false;
        }
    }
?>