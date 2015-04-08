<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:13
 */
/**
 * 1. List of bad guys (Criminal - CriminalCollection)
 * 2. Criminal (id, name, dangerPoints, reward)
 * 3. Inform the Central
 * 4. List of fugitives to be hunted (CriminalCollection)
 * 5. List of informants (Informant - InformantCollection)
 * 6. Informant::getContactInfo() : location, photo, history
 * 7. An Informant Contact might be a Criminal, or not.
 */

spl_autoload_extensions('.php');
spl_autoload_register();

use Domain\Entities\Criminal;
use Domain\Entities\HuntingPlan;
use Domain\Entities\Informant;
use Domain\Entities\Person;


function main()
{
    // weekly criminal list
    $criminalsInfoList = Domain\Services::getCJEMondayList();

    // personal informant list
    $network = Domain\Services::getMyInformantNetwork();

    // fresh new hunting plan for the week
    $weekHuntingPlan = new HuntingPlan();

    foreach ($criminalsInfoList as $criminalInfo) {
        /** @var $criminalInfo Criminal\Info */

        // get contact information from the informant network
        if ($info = $network->getContactInfoForCriminal($criminalInfo->getName())) {

            // schedule optimized for later access
            $weekHuntingPlan->scheduleCriminal($criminalInfo, $info);

            continue;
        }
    }

    // This is the list to send to the Central
    //@todo Service to send it to the Central $weekHuntingPlan->getMyWeekList()

    while ($nextCriminal = $weekHuntingPlan->huntNextCriminal()) {
        // this is the information provided by the informant to help me chase him
        // to do something with it...
        $nextCriminal->getContactInfo();

        // this is the time needed to chase the criminal
        $nextCriminal->getCriminalInfo()->calculateTime();

        //@todo calculate if the week is over or not, using the calculatedTime
    }
    return $weekHuntingPlan;
}


main();