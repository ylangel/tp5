<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 13:54
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use app\common\controller\Email;
use think\Request;

class Common extends Controller
{
    public $user_id = "";

    public $com_data = [];

    public function _initialize(){
        $user_info = Session::get("user_info");
        if (!empty($user_info)) {

            //管理员信息
            $this->user_id = $user_info["admin_id"];
            $this->com_data["user_info"] = $user_info;

            //一级类目
            $rule_list = Db::table("yl_admin_rule")
                ->field('rule_id,rule_name')
                ->where(["rule_status"=>"Y","rule_parent"=>"0"])
                ->order("rule_sort","asc")
                ->select();
            $this->com_data["rule_list"] = $rule_list;


        } else {
            $this->redirect("/login.html");
        }
    }
}