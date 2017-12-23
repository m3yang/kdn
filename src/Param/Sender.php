<?php

namespace FastFood\Param;

class Sender
{
    protected $name;
    protected $mobile;
    protected $province_name;
    protected $city_name;
    protected $exp_area_name;
    protected $address;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Sender
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     * @return Sender
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProvinceName()
    {
        return $this->province_name;
    }

    /**
     * @param mixed $province_name
     * @return Sender
     */
    public function setProvinceName($province_name)
    {
        $this->province_name = $province_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->city_name;
    }

    /**
     * @param mixed $city_name
     * @return Sender
     */
    public function setCityName($city_name)
    {
        $this->city_name = $city_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpAreaName()
    {
        return $this->exp_area_name;
    }

    /**
     * @param mixed $exp_area_name
     * @return Sender
     */
    public function setExpAreaName($exp_area_name)
    {
        $this->exp_area_name = $exp_area_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return Sender
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
}