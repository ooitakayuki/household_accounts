<?php
namespace Repository;

use Common\Database;
use Common\DatabaseException;
use Dto\Expense;

class ExpenseRepository
{
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
     * @return Expense[]
     */
    public function find_all(): array {
        $sql = 'SELECT * FROM expense';
        $sql .= ' ORDER BY id ASC';
        $result = [];
        try {
            $result = $this->db->execute($sql, []);
        } catch (DatabaseException $e) {
            error_log($e);
        }

        $data = [];
        foreach ($result as $item) {
            $data[] = Expense::wrap($item);
        }

        return $data;
    }
}