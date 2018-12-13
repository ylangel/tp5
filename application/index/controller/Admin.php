<?php

namespace app\index\controller;

use app\index\controller\Common;

class Admin extends Common
{
    /**
     * 管理员列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $model = model("Admin");
        $this->com_data["admin_list"] = $model->select()->toArray();
        return $this->fetch("/Admin/index",$this->com_data);
    }

}
