<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 11:02
 */

namespace Domain\Entities;

class HuntingPlan {

    /** @var Person\Collection */
    protected $criminals;

    /**
     * @var array Array with criminal ids, sorted by profitability.
     *            array(array (
     *              'id' =>,
     *              'profitability' =>
     *            ))
     */
    protected $plan = [];

    /**
     * Clears the timetable
     * @return $this
     */
    public function clear()
    {
        $this->criminals->clear();
        return $this;
    }

    /**
     * @param $criminalInfo Criminal\Info
     * @param $contactInfo Contact\Info
     */
    public function scheduleCriminal($criminalInfo, $contactInfo)
    {
        // Create a criminal
        $criminal = new Criminal();
        $criminal->setContactInfo($contactInfo);
        $criminal->setCriminalInfo($criminalInfo);

        // stores the criminal
        $this->criminals->add($criminal, $criminalInfo->getId());

        // update array with ids
        $this->updatePlan($criminal);
    }

    /**
     * Returns the next criminal to be hunted and removes it from the schedule.
     *
     * @return Criminal|null
     */
    public function huntNextCriminal()
    {
        // Hunting is completed!
        if (!$this->plan) {
            return null;
        }

        // remove the next criminal from the hunting plan
        $nextItem = array_shift($this->plan);

        return $this->criminals->getWithKey($nextItem['id']);
    }

    /**
     * Complexity: O(n). We can have O(n/2) if we jump always to the middle of the
     * remaining array.
     *
     * @param $criminal Criminal
     */
    protected function updatePlan($criminal)
    {
        $newProfitability = $criminal->calculateProfitability();

        //@todo We can do it faster jumping always to the middle of the remaining array
        foreach ($this->plan as $pos => $item) {

            if ($newProfitability >= $item['profitability']) {
                $newElem = array(
                    'id' => $criminal->getCriminalInfo()->getId(),
                    'profitability' => $newProfitability,
                );
                //@todo complexity
                array_splice($this->plan, $pos, 0, $newElem);
                break;
            }
        }
    }
}