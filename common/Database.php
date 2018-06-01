<?php
namespace Common;

use Config\DbConfig;

class DatabaseException extends \Exception {
}

class Database
{
    /**
     * @var Database
     */
	public static $instance = null;

    /**
     * @var \PDO
     */
	protected $_connection;

    /**
     * @return Database
     */
	public static function instance()
	{
		if (!isset(static::$instance))
		{
			new Database();
		}
		return static::$instance;
	}
	protected function __construct()
	{
		static::$instance = $this;
	}
	final public function __destruct()
	{
		$this->disconnect();
	}
	public function connect()
	{
		$this->_connection = new \PDO(DbConfig::PDO_DNS, DbConfig::DATABASE_USER, DbConfig::DATABASE_PASSWARD);
		$this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}
	public function disconnect()
	{
		$this->_connection = null;
		return true;
	}

    /**
     * @param $sql
     * @param $values
     * @return mixed
     * @throws DatabaseException
     */
	public function execute($sql, $values)
	{
		$this->_connection or $this->connect();
		// 値がない場合はそのまま実行する
		if ($values === null) {
			$count = $this->_connection->exec($sql);
			return $count;
		}
		
		try {
			$sth = $this->_connection->prepare($sql);
		} catch (\PDOException $e) {
			error_log($e->getMessage());
			throw new DatabaseException('fail prepare.'.$sql);
		}
		if (!$sth->execute($values)) {
			throw new DatabaseException('insert faild. sql:'.$sth->queryString);
		}
		$type = strtoupper(substr(ltrim($sql,'('), 0, 6));
		$result = null;
		switch($type)
		{
			case 'SELECT':
				$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
				break;
			case 'INSERT':
			case 'CREATE':
				return $this->_connection->lastInsertId();
				break;
			case 'UPDATE':
				return $sth->rowCount();
				break;
			default:
				break;
		}
		return $result;
	}
	/**
	 * Start a transaction
	 *
	 * @return bool
	 */
	public function start_transaction()
	{
		$this->_connection or $this->connect();
		return $this->_connection->beginTransaction();
	}
	/**
	 * Commit a transaction
	 *
	 * @return bool
	 */
	public function commit_transaction()
	{
		return $this->_connection->commit();
	}
	/**
	 * Rollback a transaction
	 * @return bool
	 */
	public function rollback_transaction()
	{
		return $this->_connection->rollBack();
	}
}
