<?php

namespace app\index\controller;

use think\Controller;
use app\index\controller\Common;
use think\Db;

class Rbac extends Common
{
    //权限列表
    public function auth(){
        $this->com_data["rule_lists"] = Db::table("yl_admin_rule")->where('rule_parent',0)->select();
        return $this->fetch("/Admin/auth",$this->com_data);
    }

    //角色列表
    public function role(){
        $model = model("Rbac");
        $this->com_data["role_list"] = $model->get_role_list();
        return $this->fetch("/Admin/role",$this->com_data);
    }
}
