<?php
namespace Repository;

use Common\Database;
use Common\DatabaseException;

class Expense
{
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

    public function findAll() {
        $sql = 'SELECT * FROM expense';
        $sql .= ' ORDER BY id ASC';
        $data = [];
        try {
            $data = $this->db->execute($sql, []);
        } catch (DatabaseException $e) {
            error_log($e);
        }
        return $data;
    }
}