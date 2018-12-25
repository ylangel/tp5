<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 13:53
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller
{
    //登录
    public function login(){
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $model = model("Admin");
            $res = $model->where(["admin_email"=>$data["email"],"admin_password"=>$data["password"]])->find();
            if ($res) {
                Session::set("user_info",$res);
                //获取用户权限id 路径
                $sql = "SELECT d.rule_id,d.rule_name,d.rule_path FROM yl_admin_role a
                        LEFT JOIN yl_admin_author b ON a.author_id = b.author_id AND b.author_status = 'Y'
                        LEFT JOIN yl_admin_role_rule c ON b.author_id = c.author_id
                        LEFT JOIN yl_admin_rule d ON c.rule_id = d.rule_id AND d.rule_status = 'Y'
                        WHERE a.admin_id = ? AND d.rule_id > 0
                        GROUP BY d.rule_id";
                $res = Db::query($sql,array($res["admin_id"]));
                $ruth_id = array();
                $ruth_path = array();
                if($res){
                    foreach ($res as $v) {
                        $ruth_id[] = intval($v["rule_id"]);
                        $ruth_path[] = trim($v["rule_path"]);
                    }
                }
                $ruth['ids'] = implode(',',$ruth_id);
                $ruth['paths'] = implode(',',$ruth_path);
                Session::init(['prefix' => 'yl', 'auto_start' => true, 'expire' => 86400]);
                Session::set("user_auth",$ruth);
                return json(['data'=>"",'code'=>1,'message'=>'登录成功']);
            } else {
                return json(['data'=>"",'code'=>0,'message'=>'登录失败']);
            }
        } else {
            Session::delete("user_info");
            return $this->fetch("/User/login");
        }
    }

    //注册
    public function register(){

    }
}