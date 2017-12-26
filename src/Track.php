<?php

namespace FastFood;

class Track
{
    const API_PRODUCTION = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';

    /**
     * 使用的api
     *
     * @var string
     */
    protected $api_track = self::API_PRODUCTION;

    protected $order_code;
    protected $shipper_code;
    protected $logistic_code;

    /**
     * @return string
     */
    public function getOrderCode()
    {
        return $this->order_code;
    }

    /**
     * @param string $order_code
     * @return Track
     */
    public function setOrderCode($order_code)
    {
        $this->order_code = $order_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipperCode()
    {
        return $this->shipper_code;
    }

    /**
     * @param string $shipper_code
     * @return Track
     */
    public function setShipperCode($shipper_code)
    {
        $this->shipper_code = $shipper_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogisticCode()
    {
        return $this->logistic_code;
    }

    /**
     * @param string $logistic_code
     * @return Track
     */
    public function setLogisticCode($logistic_code)
    {
        $this->logistic_code = $logistic_code;
        return $this;
    }
    
    public function query()
    {
        
    }
}