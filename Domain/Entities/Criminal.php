<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:36
 */

namespace Domain\Entities;


class Criminal extends Person {

    /** @var Criminal\Info */
    protected $criminalInfo;

    /** @var Contact\Info; */
    protected $contactInfo;

    /**
     * @param Contact\Info $contactInfo
     */
    public function setContactInfo($contactInfo)
    {
        $this->contactInfo = $contactInfo;
    }

    /**
     * @return Contact\Info
     */
    public function getContactInfo()
    {
        return $this->contactInfo;
    }

    /**
     * @param Criminal\Info $criminalInfo
     */
    public function setCriminalInfo($criminalInfo)
    {
        $this->criminalInfo = $criminalInfo;
    }

    /**
     * @return Criminal\Info
     */
    public function getCriminalInfo()
    {
        return $this->criminalInfo;
    }

    /**
     * Calculates the profitability of chasing this criminal.
     *
     * @return float
     */
    public function calculateProfitability()
    {
        if (!$this->criminalInfo) {
            return 0.0;
        }

        $reward = $this->criminalInfo->getReward();
        $dangerPoints = $this->criminalInfo->getDangerPoints();

        return floatval($reward) / floatval($dangerPoints);
    }

    /**
     * Time in hours neede to chase the criminal.
     *
     * @return float
     */
    public function calculateTime()
    {
        if (!$this->criminalInfo) {
            return 0.0;
        }

        return $this->criminalInfo->getDangerPoints();
    }
}