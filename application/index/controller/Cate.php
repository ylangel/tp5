<?php

namespace app\index\controller;

use app\index\controller\Common;
use app\index\model\PddCate;
use think\Request;
use app\common\controller\Pdd;

class Cate  extends Common
{
    public function _initialize() {
        parent::_initialize();
        $this->view->engine->layout('Layout/header');
    }

    public function cateList(Request $request){

        if ($request->has("cat_id","get")) {
            $cat_id = $request->get("cat_id");
            $where = ['parent_cat_id'=>$cat_id];
        } else {
            $where = ['level'=>'1'];
        }

        $model = new PddCate();
        $list = $model->where($where)->paginate(12);
        $page = $list->render();

        $this->com_data['cates'] = $list;
        $this->com_data['page'] = $page;
        unset($model);
        return $this->fetch('/cate/pdd', $this->com_data);
    }

    public function aa(){
        $pdd_model = new Pdd();
        $data = $pdd_model->theme_goods(4133);
        dump($data);
    }

}