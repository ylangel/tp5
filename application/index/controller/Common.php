<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 13:54
 */

namespace app\index\controller;

use think\Controller;

class Common extends Controller
{
    public $user_data = [];

    public function _initialize()
    {
        if (1==1) {
            $this->user_data = array(
                "user_name" => "赵杰",
                "user_age" => "18",
            );
        } else {
            $this->redirect("/login");
        }
    }

}