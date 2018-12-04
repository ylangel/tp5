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

// 数组保存到文件
function arr2file($filename, $arr=''){
    if(is_array($arr)){
        $con = var_export($arr,true);
    } else{
        $con = $arr;
    }
    $con = "<?php\nreturn $con;\n?>";//\n!defined('IN_MP') && die();\nreturn $con;\n
    write_file($filename, $con);
}

function mkdirss($dirs,$mode=0777) {
    if(!is_dir($dirs)){
        mkdirss(dirname($dirs), $mode);
        return @mkdir($dirs, $mode);
    }
    return true;
}

function write_file($l1, $l2=''){
    $dir = dirname($l1);
    if(!is_dir($dir)){
        mkdirss($dir);
    }
    return @file_put_contents($l1, $l2);
}

function read_file($l1){
    return @file_get_contents($l1);
}

// 转换成JS
function t2js($l1, $l2=1){
    $I1 = str_replace(array("\r", "\n"), array('', '\n'), addslashes($l1));
    return $l2 ? "document.write(\"$I1\");" : $I1;
}

//utf8转gbk
function u2g($str){
    return iconv("UTF-8","GBK",$str);
}

//gbk转utf8
function g2u($str){
    return iconv("GBK","UTF-8//ignore",$str);
}

//获取当前地址栏URL
function http_url(){
    return htmlspecialchars("http://".$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);
}

// 获取相对目录
function get_base_path($filename){
    $base_path = $_SERVER['PHP_SELF'];
    $base_path = substr($base_path,0,strpos($base_path,$filename));
    return $base_path;
}

// 获取相对路径
function get_base_url($baseurl,$url){
    if("#" == $url){
        return "";
    }elseif(FALSE !== stristr($url,"http://")){
        return $url;
    }elseif( "/" == substr($url,0,1) ){
        $tmp = parse_url($baseurl);
        return $tmp["scheme"]."://".$tmp["host"].$url;
    }else{
        $tmp = pathinfo($baseurl);
        return $tmp["dirname"]."/".$url;
    }
}

//输入过滤 同时去除连续空白字符可参考扩展库的remove_xss
function get_replace_input($str,$rptype=0){
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    $str = get_replace_nb($str);
    return addslashes($str);
}

//去除换行
function get_replace_nr($str){
    $str = str_replace(array("<nr/>","<rr/>"),array("\n","\r"),$str);
    return trim($str);
}

//去除连续空格
function get_replace_nb($str){
    $str = str_replace("&nbsp;",' ',$str);
    $str = str_replace("　",' ',$str);
    $str = ereg_replace("[\r\n\t ]{1,}",' ',$str);
    return trim($str);
}

//去除所有标准的HTML代码
function get_replace_html($str, $start=0, $length, $charset="utf-8", $suffix=false){
    return msubstr(eregi_replace('<[^>]+>','',ereg_replace("[\r\n\t ]{1,}",' ',get_replace_nb($str))),$start,$length,$charset,$suffix);
}

//判断是否属于当前模块
function check_model($modelname){
    if(strtolower(MODULE_NAME) == $modelname){
        return 1;
    }
    return 0;
}

//对象转化数组
function obj2arr($obj) {
    return json_decode(json_encode($obj),true);
}