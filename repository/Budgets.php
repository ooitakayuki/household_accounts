<?php
namespace Repository;

use Common\Database;

class Budgets {
    private $db;

    function __construct($db = null) {
        $this->db = $db;
        if ($this->db === null) {
            $this->db = Database::instance();
        }
    }

    public function find($offset, $limit, $sort = 'DESC') {
		$sql = 'SELECT * FROM budgets';
		$sql .= ' ORDER BY id '.$sort;
        $sql .= ' LIMIT '.$offset.' '.$limit;
		$data = array();
		try {
			$data = $this->db->execute($sql, $values);
		} catch (DatabaseException $e) {
			error_log($e);
		}
		return $data;
    }

    public function add($values) {
		$keys = array_keys($values);
		$sql = 'INSERT INTO '.$table.' ('.implode(', ', $keys).') VALUES (:'.implode(', :', $keys).')';
		$id = '';
		$this->db->start_transaction();
		try {
			$id = $this->db->execute($sql, $values);
			$this->db->commit_transaction();
		} catch (DatabaseException $e) {
			error_log($e);
			$this->db->rollback_transaction();
			return false;
		}
		return $id;
    }
}
