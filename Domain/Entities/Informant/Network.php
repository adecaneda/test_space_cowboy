<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:45
 */

namespace Domain\Entities\Informant;
use Domain\Entities\Contact;
use Domain\Entities\Criminal;
use Domain\Entities\Informant;
use Domain\Entities\Person;

class Network {

    /**
     * @var Person\Collection
     */
    protected $informants;

    /**
     * Complexity: O(1) + O(n)
     *
     * @param $name string
     * @return Contact\Info|null
     */
    public function getContactInfoForCriminal($name)
    {
        if (!$this->informants) {
            return null;
        }

        // if the criminal is one of my active informants, skip it.
        if ($criminalInformant = $this->informants->getWithKey($name)) {
            /** @var $criminalInformant Informant */
            if ($criminalInformant->getIsActive()) {
                return null;
            }
        }

        foreach ($this->informants as $informant) {
            /** @var $informant Informant */
            if ($contactInfo = $informant->getContactInfo($name)) {
                return $contactInfo;

            } else {
                // mark it as "huntable"
                $informant->setIsActive(false);
            }
        }
        return null;
    }

    /**
     * informants are inserted in a way that retrieving is optimized, using the
     * name is a unique index.
     *
     * @param $informant Informant
     * @return $this
     */
    public function addInformant($informant)
    {
        $this->informants->add($informant, $informant->getName());
        return $this;
    }
}