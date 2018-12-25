<?php

namespace app\index\controller;

use app\index\controller\Common;
use app\index\model\PddCate;

class Cate  extends Common
{
    public function _initialize() {
        parent::_initialize();
        $this->view->engine->layout('Layout/header');
    }

    public function cateList(){
        $model = new PddCate();
        $this->com_data["cates"] = $model->where("level","1")->select()->toArray();
        unset($model);
        return $this->fetch('/cate/pdd', $this->com_data);
    }

    public function childCateList(){

    }
}