<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

//常量
/*----------------------------------------------------------*/

define('PDD_CLIENT_ID','15d1ff0854b94ac7a2ab8223c1faeb05');
define('PDD_CLIENT_SECRET','5899b12e10505e9852a7c016415a14f2b0716f10');

//公共方法
/*----------------------------------------------------------*/

// 数组保存到文件
function arr2file($filename, $arr=''){
    if(is_array($arr)){
        $con = var_export($arr,true);
    } else{
        $con = $arr;
    }
    $con = "<?php\nreturn $con;\n?>";
    write_file($filename, $con);
}

//去除连续空格
function get_replace_nb($str){
    $str = preg_replace ( "/\s(?=\s)/","\\1", $str);
    return trim($str);
}

//去除所有标准的HTML代码
function get_replace_html($str, $start=0, $length, $charset="utf-8", $suffix=false){
    return msubstr(eregi_replace('<[^>]+>','',ereg_replace("[\r\n\t ]{1,}",' ',get_replace_nb($str))),$start,$length,$charset,$suffix);
}

//通用 curl 请求方法
function curlRequest($url, $type = 'POST', $params = '', $cookie = '', $header = array(), $headback = 0) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $headback);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); //网页重定向
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // 在发起连接前等待的时间，如果设置为0，则无限等待
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);   // 设置cURL允许执行的最长秒数
    if (!empty($cookie)) {
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if (!empty($header)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过ssl认证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    switch ($type) {
        case 'GET' : curl_setopt($ch, CURLOPT_HTTPGET, true);
            break;
        case 'POST': curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'PUT' : curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'DELETE':curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
    }
    $curlData = curl_exec($ch);
    $curlErrno = curl_errno($ch);
    curl_close($ch);
    if ($curlErrno > 0) {
        return json_encode(array());
    }
    return $curlData;
}