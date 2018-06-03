<?php
namespace Dto;


class Budgets implements Dto
{
    public $id;
    public $type;
    public $item_name;
    public $expense_id;
    public $expense_name;
    public $amount;
    public $created_at;

    /**
     * @param array $array
     * @return Budgets
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