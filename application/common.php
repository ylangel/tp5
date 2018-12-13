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
    $con = "<?php\nreturn $con;\n?>";
    write_file($filename, $con);
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

//去除换行
function get_replace_nr($str){
    $str = str_replace(array("<nr/>","<rr/>"),array("\n","\r"),$str);
    return trim($str);
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