<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:36
 */

namespace Domain\Entities;


class Informant extends Person {

    /**
     * @var Person\Collection Indexed by contact name
     */
    protected $contacts;

    protected $isActive;


    public function __construct($data)
    {
        parent::__construct($data);

        // Fast an easy way to create criminals
        $this->isActive = true;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Complexity: O(1) since the array is indexed by name
     * @param string $name
     * @return Contact\Info|null
     */
    public function getContactInfo($name)
    {
        /** @var $contact Contact */
        if (!$contact = $this->contacts->getWithKey($name)) {
            return null;
        }
        return $contact->getInfo();
    }

    /**
     * Contacts are inserted in a way that retrieving is optimized, using the
     * name is a unique index.
     *
     * @param $contact Contact
     * @return $this
     */
    public function addContact($contact)
    {
        $this->contacts->add($contact, $contact->getName());
        return $this;
    }
} 