<?php
namespace Dto;

class Expense implements Dto
{
    public $id;
    public $expense_name;

    /**
     * @param array $array
     * @return Expense
     */
    static public function wrap(array $array): Dto {
        $keys = array_keys(get_class_vars(__CLASS__));
        $object = new self;

        foreach ($keys as $key) {
            if (isset($array[$key])) {
                $object->$key = $array[$key];
            }
        }

        return $object;
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return get_object_vars($this);
    }
}