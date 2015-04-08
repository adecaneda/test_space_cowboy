<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 11:21
 */

namespace Domain;
use Domain\Entities\Criminal;
use Domain\Entities\Informant;

class Services {

    /**
     * Get the monday list with criminals to be hunted.
     *
     * @return array
     */
    static public function getCJEMondayList()
    {
        //@todo
        return array(
            new Criminal\Info(array(
                'id' => 44,
                'name' => 'Steve',
                'reward' => 100,
                'dangerPoints' => 6,
            )),
            new Criminal\Info(array(
                'id' => 23,
                'name' => 'Miller',
                'reward' => 100,
                'dangerPoints' => 4,
            ))
        );
    }

    /**
     * @return Informant\Network
     */
    static public function getMyInformantNetwork()
    {
        //@todo
        // uses Network::addInformant
        return new Informant\Network();
    }

} 