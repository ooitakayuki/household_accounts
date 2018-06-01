<?php
namespace Request;

class IndexRequest extends Request {
    public $page = 1;
    public $from;
    public $to;
    public $expense_id;
    public $refinement;

    function __construct()
    {
        $this->from = date('Y-m-d', strtotime('-1 month'));
        $this->to = date('Y-m-d', time());
        parent::__construct();
    }

    public function validate(): bool {
        if (isset($this->expense_id) && !is_numeric($this->expense_id)) {
            $this->expense_id = null;
        }

        return true;
    }

    public function values(): array
    {
        return get_object_vars($this);
    }

    public function set_parameter()
    {
        $vars = get_class_vars(__CLASS__);
        $keys = array_keys($vars);

        foreach($keys as $key) {
            if (isset($_GET[$key])) {
                $this->$key = $_GET[$key];
            }
        }
    }
}
