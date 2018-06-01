<?php
namespace Repository;

use Common\Database;
use Common\DatabaseException;

class Budgets {
    /**
     * @var Database
     */
    private $db;

    /**
     * Budgets constructor.
     * @param \Common\Database $db
     */
    function __construct($db = null) {
        $this->db = $db;
        if ($this->db === null) {
            $this->db = Database::instance();
        }
    }

    public function find($offset, $limit, $sort = 'DESC') {
		$sql = 'SELECT * FROM budgets as b LEFT JOIN expense as e ON e.id = b.expense_id';
		$sql .= ' ORDER BY b.id '.$sort;
        $sql .= ' LIMIT '.$offset.', '.$limit;
		$data = [];
		try {
			$data = $this->db->execute($sql, []);
		} catch (DatabaseException $e) {
			error_log($e);
		}
		return $data;
    }

    public function add($values) {
		$keys = array_keys($values);
		$sql = 'INSERT INTO budgets'.' ('.implode(', ', $keys).') VALUES (:'.implode(', :', $keys).')';
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
