<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:41
 */

namespace Domain\Entities\Criminal;


class Info {

    protected $name;
    protected $id;
    protected $dangerPoints;
    protected $reward;

    public function __construct($data)
    {
        // Fast an easy way to create criminals
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->reward = $data['reward'];
        $this->dangerPoints = $data['dangerPoints'];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDangerPoints()
    {
        return $this->dangerPoints;
    }

    /**
     * @return float
     */
    public function getReward()
    {
        return $this->reward;
    }

}