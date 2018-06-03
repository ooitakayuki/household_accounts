<?php
namespace Repository;

use Common\Database;
use Common\DatabaseException;
use Dto\Budgets;

class BudgetsRepository {
    /**
     * @var Database
     */
    private $db;

    /**
     * BudgetsRepository constructor.
     * @param \Common\Database $db
     */
    function __construct($db = null) {
        $this->db = $db;
        if ($this->db === null) {
            $this->db = Database::instance();
        }
    }

    /**
     * @param $offset
     * @param $limit
     * @param string $sort
     * @return Budgets[]
     */
    public function find($offset, $limit, $sort = 'DESC') {
		$sql = 'SELECT * FROM budgets as b LEFT JOIN expense as e ON e.id = b.expense_id';
		$sql .= ' ORDER BY b.created_at '.$sort;
        $sql .= ' LIMIT '.$offset.', '.$limit;
		$result = [];

		try {
			$result = $this->db->execute($sql, []);
		} catch (DatabaseException $e) {
			error_log($e);
		}

		$data = [];
		foreach ($result as $item) {
		    $data[] = Budgets::wrap($item);
        }

		return $data;
    }

    /**
     * @param $type
     * @param $from
     * @param $to
     * @param null $expense_id
     * @return mixed
     */
    public function sum_with_distance($type, $from, $to, $expense_id = null) {
        $sql = 'SELECT sum(amount) as amount_sum FROM budgets';
        $sql .= ' WHERE type = :type AND created_at BETWEEN :from AND :to';
        $bind = [
            'type' => $type,
            'from' => $from,
            'to' => $to,
        ];

        if ($expense_id != null) {
            $sql .= ' AND expense_id = :expense_id';
            $bind['expense_id'] = $expense_id;
        }

        $data = 0;
        try {
            $data = $this->db->execute($sql, $bind);
        } catch (DatabaseException $e) {
            error_log($e);
        }

        return isset($data[0]['amount_sum']) ? $data[0]['amount_sum'] : 0;
    }

    /**
     * @param $from
     * @param $to
     * @param null $expense_id
     * @return Budgets[]
     */
    public function find_with_distance($from, $to, $expense_id = null) {
        $sql = 'SELECT * FROM budgets as b LEFT JOIN expense as e ON e.id = b.expense_id';
        $sql .= ' WHERE b.created_at BETWEEN :from AND :to';
        $bind = [
            'from' => $from,
            'to' => $to,
        ];

        if ($expense_id != null) {
            $sql .= ' AND expense_id = :expense_id';
            $bind['expense_id'] = $expense_id;
        }

        $sql .= ' ORDER BY b.created_at DESC';

        $result = [];
        try {
            $result = $this->db->execute($sql, $bind);
        } catch (DatabaseException $e) {
            error_log($e);
        }

        $data = [];
        foreach ($result as $item) {
            $data[] = Budgets::wrap($item);
        }

        return $data;
    }

    /**
     * @param $values
     * @return bool|mixed|null
     */
    public function add($values) {
		$keys = array_keys($values);
		$sql = 'INSERT INTO budgets'.' ('.implode(', ', $keys).') VALUES (:'.implode(', :', $keys).')';
		$id = null;
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
