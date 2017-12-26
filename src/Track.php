<?php

namespace FastFood;

class Track extends Core
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
        $request_data = $this->formatRequestData();
        $datas = array(
            'EBusinessID' => $this->e_business_id,
            'RequestType' => '1002',
            'RequestData' => urlencode($request_data),
            'DataType' => 2,
        );
        $datas['DataSign'] = encrypt($requestData, AppKey);
        $result=sendPost(ReqURL, $datas);

        //根据公司业务处理返回的信息......

        return $result;
    }

    protected function formatRequestData()
    {
        $arr = [
            'ShipperCode' => $this->getShipperCode(),
            'LogisticCode' => $this->getLogisticCode(),
        ];
        if (!empty($this->getOrderCode())) {
            $arr['OrderCode'] = $this->getOrderCode();
        }
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }
}