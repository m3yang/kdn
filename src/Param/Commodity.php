<?php

namespace FastFood\Param;

class Commodity
{
    protected $goods_name;
    protected $goods_code;
    protected $goods_quantity;
    protected $goods_price;
    protected $goods_weight;
    protected $goods_desc;
    protected $goods_vol;

    /**
     * @return mixed
     */
    public function getGoodsName()
    {
        return $this->goods_name;
    }

    /**
     * @param mixed $goods_name
     * @return Commodity
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoodsCode()
    {
        return $this->goods_code;
    }

    /**
     * @param mixed $goods_code
     * @return Commodity
     */
    public function setGoodsCode($goods_code)
    {
        $this->goods_code = $goods_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoodsQuantity()
    {
        return $this->goods_quantity;
    }

    /**
     * @param mixed $goods_quantity
     * @return Commodity
     */
    public function setGoodsQuantity($goods_quantity)
    {
        $this->goods_quantity = $goods_quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoodsPrice()
    {
        return $this->goods_price;
    }

    /**
     * @param mixed $goods_price
     * @return Commodity
     */
    public function setGoodsPrice($goods_price)
    {
        $this->goods_price = $goods_price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoodsWeight()
    {
        return $this->goods_weight;
    }

    /**
     * @param mixed $goods_weight
     * @return Commodity
     */
    public function setGoodsWeight($goods_weight)
    {
        $this->goods_weight = $goods_weight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoodsDesc()
    {
        return $this->goods_desc;
    }

    /**
     * @param mixed $goods_desc
     * @return Commodity
     */
    public function setGoodsDesc($goods_desc)
    {
        $this->goods_desc = $goods_desc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoodsVol()
    {
        return $this->goods_vol;
    }

    /**
     * @param mixed $goods_vol
     * @return Commodity
     */
    public function setGoodsVol($goods_vol)
    {
        $this->goods_vol = $goods_vol;
        return $this;
    }
}