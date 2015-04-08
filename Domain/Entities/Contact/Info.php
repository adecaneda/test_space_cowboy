<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:41
 */

namespace Domain\Entities\Contact;


class Info {

    /** @var string */
    protected $location;

    /** @var string */
    protected $crimeHistory;

    /** @var string */
    protected $photo;

    /**
     * @return string
     */
    public function getCrimeHistory()
    {
        return $this->crimeHistory;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
} 