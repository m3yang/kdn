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
     * @var string 请求参数 json_encode处理的数据
     */
    protected $request_data;

    /**
     * @var string （未经处理的）返回结果
     */
    protected $response_body;

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
        $datas['DataSign'] = $this->encrypt($request_data, $this->app_key);
        $response_body = $this->sendPost($this->api_track, $datas);
        $result = json_decode($response_body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new KdnException(json_last_error_msg());
        }
        $this->request_data = $request_data;
        $this->response_body = $response_body;
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