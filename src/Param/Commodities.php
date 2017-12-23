<?php

namespace FastFood\Param;

class Commodities
{
    protected $all;

    public function __construct()
    {
        $this->all = [];
    }

    public function push(Commodity $commodity)
    {
        $this->all[] = $commodity;
        return $this;
    }

    public function toArray()
    {

    }
}