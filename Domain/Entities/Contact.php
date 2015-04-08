<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 19.03.15
 * Time: 10:36
 */

namespace Domain\Entities;
use Domain\Entities;

class Contact extends Person {

    /**
     * @var Contact\Info;
     */
    protected $info;

    /**
     * @return Contact\Info
     */
    public function getInfo()
    {
        return $this->info;
    }
} 