<?php

namespace app\common\model;

class PddSdk
{
    //client_id
    private $client_id = "";

    //client_secret
    private $client_secret = "";

    //通过code获取的access_token(无需授权的接口，该字段不参与sign签名运算)
    private $access_token = "";

    //时间戳
    private $timestamp = "";

    //返回数据类型 非必填
    private $data_type = "JSON";

    //版本号 非必填
    private $version = "V1";

    public function __construct()
    {
        $this->client_id = PDD_CLIENT_ID;
        $this->client_secret = PDD_CLIENT_SECRET;
        $this->timestamp = time();
    }

    /**
     * @param $api 请求api
     * @param $param 请求参数
     * @return array 返回数据
     */
    public function pddApi($api, $param)
    {
        //公共参数
        $param['client_id'] = $this->client_id;
        $param['type'] = $api;
        $param['timestamp'] = $this->timestamp;
        $param['data_type'] = $this->data_type;
        $param['version'] = $this->version;
        //键排序
        ksort($param);
        //生成签名
        $sign = $this->computeSignature($param);
        $param['sign'] = $sign;
        $url = 'http://gw-api.pinduoduo.com/api/router';
        $res = curlRequest($url,"POST",$param);
        return json_decode($res,true,512,JSON_BIGINT_AS_STRING);
    }

    //签名
    private function computeSignature($param)
    {
        $str = "";
        //拼接的字符串
        foreach ($param as $k => $v) $str .= $k . $v;
        //生成签名 MD5加密转大写
        $sign = strtoupper(md5($this->client_secret. $str . $this->client_secret));
        return $sign;
    }
}