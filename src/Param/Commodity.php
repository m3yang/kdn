<?php

namespace FastFood\Kdn\Param;

use JsonSerializable;

class Commodity implements JsonSerializable
{
    protected $all;

    public function __construct()
    {
        $this->all = [];
    }

    public function push(CommodityItem $commodityItem)
    {
        $this->all[] = $commodityItem;
        return $this;
    }

    public function jsonSerialize()
    {
        return $this->all;
    }
}