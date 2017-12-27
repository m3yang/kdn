<?php

namespace FastFood;

use FastFood\Param\Address;

/**
 * Class EOrder
 *
 * @see http://www.kdniao.com/api-eorder
 *
 * @package FastFood
 */
class EOrder extends Core
{
    const PAY_TYPE_CASH = 1; //1-现付
    const EXP_TYPE_STANDARD = 1; //1-标准快件

    const API_PRODUCTION = 'http://api.kdniao.cc/api/Eorderservice';
    const API_TESTING = 'http://testapi.kdniao.cc:8081/api/EOrderService';

    /**
     * 使用的api
     *
     * @var string
     */
    protected $api_e_order = self::API_PRODUCTION;

    protected $order_code;
    protected $shipper_code;
    protected $pay_type;
    protected $exp_type;
    protected $sender;
    protected $receiver;
    protected $commodity;

    /**
     * @var string 请求参数 json_encode处理的数据
     */
    protected $request_data;

    /**
     * @var string （未经处理的）返回结果
     */
    protected $response_body;

    /**
     * 使用测试接口
     *
     * @return $this
     */
    public function useTestingApi()
    {
        $this->api_e_order = self::API_TESTING;
        return $this;
    }

    /**
     * 使用生产接口
     *
     * @return $this
     */
    public function useProductionApi()
    {
        $this->api_e_order = self::API_PRODUCTION;
        return $this;
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
     * @param Address $sender
     * @return EOrder
     */
    public function setSender(Address $sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return Address
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param Address $receiver
     * @return EOrder
     */
    public function setReceiver(Address $receiver)
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @return Address
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

    /**
     * 提交电子面单
     *
     * @return array
     * @throws KdnException
     */
    public function submit()
    {
        $request_data = $this->formatRequestData();
        $datas = array(
            'EBusinessID' => $this->e_business_id,
            'RequestType' => '1007',
            'RequestData' => urlencode($request_data),
            'DataType' => 2,
        );
        $datas['DataSign'] = $this->encrypt($request_data, $this->app_key);
        $response_body = $this->sendPost($this->api_e_order, $datas);
        $result = json_decode($response_body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new KdnException(json_last_error_msg());
        }
        $this->request_data = $request_data;
        $this->response_body = $response_body;
        return $result;
    }

    /**
     * 获取请求数据
     *
     * @return string
     */
    public function getRequestData()
    {
        return $this->request_data;
    }

    /**
     * 获取未加工处理的返回
     *
     * @return string
     */
    public function getResponseBody()
    {
        return $this->response_body;
    }

    /**
     * 获取设置好的参数
     *
     * @return string
     */
    protected function formatRequestData()
    {
        $arr = [
            'ShipperCode' => $this->getShipperCode(),
            'OrderCode' => $this->getOrderCode(),
            'PayType' => $this->getPayType(),
            'ExpType' => $this->getExpType(),

            'Sender' => $this->getSender(),
            'Receiver' => $this->getReceiver(),
            'Commodity' => $this->getCommodity(),
        ];
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }
}
