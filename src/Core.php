<?php

namespace FastFood;

class Core
{
    protected $e_business_id;
    protected $app_key;

    public function __construct($e_business_id, $app_key)
    {
        $this->e_business_id = $e_business_id;
        $this->app_key = $app_key;
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
