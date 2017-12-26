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
}
