<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:36
 */

namespace Domain\Entities;


class Person {

    /**
     * Unique person's name, so it can be used as an identifier.
     * @var string
     */
    protected $name;

    public function __construct($data)
    {
        $this->name = $data['name'];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}