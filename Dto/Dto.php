<?php
namespace Dto;


interface Dto
{
    /**
     * @param array $array
     * @return Dto
     */
    static public function wrap(array $array): Dto;

    /**
     * @return array
     */
    public function toArray(): array;
}