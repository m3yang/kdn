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
class EOrder
{
    const API_PRODUCTION = 'http://api.kdniao.cc/api/Eorderservice';
    const API_TESTING = 'http://testapi.kdniao.cc:8081/api/EOrderService';

    const PAY_TYPE_CASH = 1; //1-现付
    const EXP_TYPE_STANDARD = 1; //1-标准快件

    protected $e_business_id;
    protected $app_key;
    protected $e_order_api;

    protected $shipper_code;
    protected $order_code;
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

    public function __construct($e_business_id, $app_key)
    {
        $this->e_business_id = $e_business_id;
        $this->app_key = $app_key;
        $this->e_order_api = self::API_PRODUCTION;
    }

    /**
     * 使用测试接口
     *
     * @return $this
     */
    public function useTestingApi()
    {
        $this->e_order_api = self::API_TESTING;
        return $this;
    }

    /**
     * 使用生产接口
     *
     * @return $this
     */
    public function useProductionApi()
    {
        $this->e_order_api = self::API_PRODUCTION;
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
        $response_body = $this->sendPost($this->e_order_api, $datas);
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

    /**
     * post提交数据
     *
     * @param string $url 请求Url
     * @param array $datas 提交的数据
     * @return url响应返回的html
     */
    protected function sendPost($url, $datas)
    {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if (empty($url_info['port'])) {
            $url_info['port'] = 80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader .= "Host:" . $url_info['host'] . "\r\n";
        $httpheader .= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader .= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader .= "Connection:close\r\n\r\n";
        $httpheader .= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets .= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     *
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    protected function encrypt($data, $appkey)
    {
        return urlencode(base64_encode(md5($data . $appkey)));
    }
}
