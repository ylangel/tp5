<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 16:58
 */

namespace app\index\controller;

use think\Controller;
use app\common\controller\PddSdk;
use think\Db;

class Test extends Controller
{
    public function pddDdkGoodsSearch(){
        set_time_limit(0);
        //获取商品
        /*$model = new PddSdk();
        $goods = $model->pddApi('pdd.ddk.goods.search',["keyword"=>"面包"]);
        dump($goods);*/
        //pdd.goods.cats.get
        //pdd.goods.opts.get
        $model = new PddSdk();
        $opts = $model->pddApi('pdd.goods.cats.get',["parent_cat_id"=>0])["goods_cats_get_response"]["goods_cats_list"];
        echo '<pre>';
        print_r($opts);
    }
}