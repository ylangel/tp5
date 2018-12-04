<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 13:53
 */

namespace app\index\controller;

use think\Controller;

class Login extends Controller
{
    //登录
    public function login(){
        return view("/User/login");
    }

    //注册
    public function register(){

    }

    //注销
    public function logout(){

    }

}