<?php
namespace Request;

class AddRequest extends Request
{
    public $type;
    public $item_name;
    public $expense_id;
    public $amount;
    public $created_at;

    public function validate(): bool
    {
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
            if (isset($_POST[$key])) {
                $this->$key = $_POST[$key];
            }
        }
    }
}