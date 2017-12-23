<?php

namespace FastFood;

use FastFood\Param\Receiver;
use FastFood\Param\Sender;

class EOrder
{
    const API_PRODUCTION = 'http://api.kdniao.cc/api/Eorderservice';
    const API_TESTING = 'http://testapi.kdniao.cc:8081/api/EOrderService';

    const PAY_TYPE_CASH = 1; //1-现付
    const EXP_TYPE_STANDARD = 1; //1-标准快件

    protected $e_business_id;
    protected $app_key;
    protected $use_api;

    protected $shipper_code;
    protected $order_code;
    protected $pay_type;
    protected $exp_type;
    protected $sender;
    protected $receiver;
    protected $commodity;

    public function __construct($e_business_id, $app_key)
    {
        $this->e_business_id = $e_business_id;
        $this->app_key = $app_key;
        $this->use_api = self::API_PRODUCTION;
    }

    public function useTestingApi()
    {
        $this->use_api = self::API_TESTING;
        return $this;
    }

    public function useProductionApi()
    {
        $this->use_api = self::API_PRODUCTION;
        return $this;
    }

    /**
     * @param mixed $shipper_code
     * @return EOrder
     */
    public function setShipperCode($shipper_code)
    {
        $this->shipper_code = $shipper_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipperCode()
    {
        return $this->shipper_code;
    }

    /**
     * @param mixed $order_code
     * @return EOrder
     */
    public function setOrderCode($order_code)
    {
        $this->order_code = $order_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderCode()
    {
        return $this->order_code;
    }

    /**
     * @param mixed $pay_type
     * @return EOrder
     */
    public function setPayType($pay_type)
    {
        $this->pay_type = $pay_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayType()
    {
        return $this->pay_type;
    }

    /**
     * @param mixed $exp_type
     * @return EOrder
     */
    public function setExpType($exp_type)
    {
        $this->exp_type = $exp_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpType()
    {
        return $this->exp_type;
    }

    /**
     * @param Sender $sender
     * @return EOrder
     */
    public function setSender(Sender $sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param Receiver $receiver
     * @return EOrder
     */
    public function setReceiver(Receiver $receiver)
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param mixed $commodity
     */
    public function setCommodity($commodity)
    {
        $this->commodity = $commodity;
    }

    /**
     * @return mixed
     */
    public function getCommodity()
    {
        return $this->commodity;
    }

    public function submit()
    {
        $request_data =
        $datas = array(
            'EBusinessID' => $this->e_business_id,
            'RequestType' => '1007',
            //'RequestData' =>
        );
    }

    protected function getRequestData()
    {
        $arr = [
            'ShipperCode' => $this->get
        ];
    }

}