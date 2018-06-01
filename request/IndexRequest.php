<?php
namespace Request;

class IndexRequest extends Request {
    public $page = 1;

    public function validate(): bool {
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
