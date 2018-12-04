<?php
namespace app\index\controller;

use app\index\controller\Common;

class Index extends Common
{
    public function index()
    {
        $data["user_data"] = $this->user_data;
        $this->view->engine->layout('Layout/header');
        return view('/Index/index',$data);
    }
}
