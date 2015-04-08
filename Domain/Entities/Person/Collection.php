<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:44
 */

namespace Domain\Entities\Person;
use Domain\Entities\Person;

class Collection {

    // indexed array
    protected $persons = array();

    /**
     * @return $this
     */
    public function clear()
    {
        $this->persons = array();
        return $this;
    }

    /**
     * @param $person Person
     * @param mixed|null $key
     * @return $this
     */
    public function add($person, $key = null)
    {
        if ($key) {
            $this->persons[$key] = $person;
        } else {
            $this->persons[] = $person;
        }
        return $this;
    }

    /**
     * @param mixed|null $pos
     *
     * @return null|Person
     */
    public function getWithPosition($pos)
    {
        return $this->getWithKey($pos);
    }

    /**
     * @param mixed|null $key
     *
     * @return null|Person
     */
    public function getWithKey($key)
    {
        if (array_key_exists($key, $this->persons)) {
            return $this->persons[$key];
        }
        return null;
    }
} 