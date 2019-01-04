<?php

namespace app\common\controller;

use app\common\model\PddSdk;
use think\Config;
use think\Controller;

class Pdd extends Controller
{
    public $pdd_model;

    public function _initialize(){
        parent::_initialize();
        $this->pdd_model = new PddSdk();
    }

    /**
     * 创建多多进宝推广位
     * pdd.ddk.goods.pid.generate
     *
     * @param int $number 要生成的推广位数量 1~100
     * @param string|array $p_id_name_list 推广位名称
     */
    public function pid_generate($number = 1, $p_id_name_list = ''){

        $p_id_name_list = $p_id_name_list ? $p_id_name_list : 'YL_'.date('YmdHis').rand(10,99);

        if ($p_id_name_list && is_array($p_id_name_list)) {
            $p_id_name_list = '[';
            foreach ($p_id_name_list as $val) {
                $p_id_name_list .= '"'.$val.'",';
            }
            $p_id_name_list = rtrim($p_id_name_list,",").']';
        } else {
            $p_id_name_list = '["'.$p_id_name_list.'"]';
        }
        $data["p_id_name_list"] = $p_id_name_list;
        $data["number"] = $number;

        return $this->pdd_model->getPddApi('pdd.ddk.goods.pid.generate',$data);
    }

    /**
     * 查询已经生成的推广位信息
     * pdd.ddk.goods.pid.query
     *
     * @param int $page 返回的页数
     * @param int $page_size 返回的每页推广位数量
     */
    public function pid_query($page = 1, $page_size = 20){

        $data = ['page'=>$page, 'page_size'=>$page_size];

        return $this->pdd_model->pddApi('pdd.ddk.goods.pid.query', $data);
    }

    /**
     * 多多进宝商品详情查询
     * pdd.ddk.goods.detail
     *
     * @param int $goods_id_list 商品ID
     * @param string $pid 推广位id
     * @param string $custom_parameters 自定义参数
     * @param string $zs_duo_id 招商多多客ID
     */
    public function goods_detail($goods_id_list, $pid = '', $custom_parameters = '', $zs_duo_id = ''){

        $goods_id_list = '['.$goods_id_list.']';

        $data['goods_id_list'] = $goods_id_list;

        $pid ? $data['pid'] = $pid : '';
        $custom_parameters ? $data['custom_parameters'] = $custom_parameters : '';
        $zs_duo_id ? $data['zs_duo_id'] = $zs_duo_id : '';

        return $this->pdd_model->pddApi('pdd.ddk.goods.detail', $data);
    }

    /**
     * 多多进宝推广链接生成
     * pdd.ddk.goods.promotion.url.generate
     *
     * @param $p_id 推广位ID
     * @param $goods_id_list 商品ID
     * @param array $params 其他参数 非必填
     * $params.generate_short_url 是否生成短链接，true-是，false-否
     * $params.multi_group true--生成多人团推广链接 false--生成单人团推广链接（默认false）1、单人团推广链接：用户访问单人团推广链接，可直接购买商品无需拼团。2、多人团推广链接：用户访问双人团推广链接开团，若用户分享给他人参团，则开团者和参团者的佣金均结算给推手
     * $params.custom_parameters 自定义参数，为链接打上自定义标签。自定义参数最长限制64个字节。
     * $params.pull_new 是否开启订单拉新，true表示开启（订单拉新奖励特权仅支持白名单，请联系工作人员开通）
     * $params.generate_weapp_webview 是否生成唤起微信客户端链接，true-是，false-否，默认false
     * $params.zs_duo_id 招商多多客ID
     * $params.generate_we_app 是否生成小程序推广
     */
    public function promotion_url_generate($p_id, $goods_id_list, $params = []){

        $data['p_id'] = $p_id;
        $data['goods_id_list'] = '['.$goods_id_list.']';

        if (is_array($params) && !empty($params)) {
            foreach ($params as $k => $val) {
                $data[$k] = $val;
            }
        } else {
            $pdd_config = Config::get('pdd');
            $promotion_url = $pdd_config['promotion_url'];
            foreach ($promotion_url as $k => $val) {
                $data[$k] = $val;
            }
        }

        return $this->pdd_model->pddApi('pdd.ddk.goods.promotion.url.generate',$data);
    }

    /**
     * 多多进宝主题列表查询
     * pdd.ddk.theme.list.get
     *
     * @param int $page 返回的页数
     * @param int $page_size 返回的每页推广位数量
     */
    public function theme_list($page = 1, $page_size = 20){

        $data = ['page'=>$page, 'page_size'=>$page_size];

        return $this->pdd_model->pddApi('pdd.ddk.theme.list.get', $data);
    }

    /**
     * 多多进宝主题商品查询
     * pdd.ddk.theme.goods.search
     *
     * @param int $theme_id 主题ID
     */
    public function theme_goods($theme_id){

        $data = ['theme_id'=>$theme_id];

        return $this->pdd_model->pddApi('pdd.ddk.theme.goods.search', $data);
    }

    /**
     * 查询订单详情
     * pdd.ddk.order.detail.get
     *
     * @param $order_sn
     * @return mixed
     */
    public function order_detail($order_sn){

        $data = ['order_sn' => $order_sn];

        return $this->pdd_model->pddApi('pdd.ddk.order.detail.get',$data);
    }

    /**
     * 多多进宝转链接口
     * pdd.ddk.goods.zs.unit.url.gen
     *
     * @param $source_url
     * @param $pid
     * @return mixed
     */
    public function zs_unit_url_gen($source_url, $pid){

        $data = ['source_url' => $source_url, 'pid' => $pid];

        return $this->pdd_model->pddApi('pdd.ddk.goods.zs.unit.url.gen',$data);
    }


}