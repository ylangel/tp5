<?php

namespace app\index\model;

use think\Model;
use think\Session;
use think\Db;

class Rbac extends Model
{
    /**
     * 检测是否有权限,通过id
     * @author zhaojie
     */
    public function check_auth($role_id) {
        $user_auth = explode(',',Session::get('user_auth')["ids"]);
        if (!in_array($role_id, $user_auth)) {
            return false;
        }
        return true;
    }

    /**
     * 检测是否有权限,通过path
     * @author zhaojie
     */
    public function check_auth_msg($role_path = '',$obj = false) {
        $user_auth = explode(',',Session::get('user_auth')["paths"]);
        if (!in_array($role_path, $user_auth)) {
            if($obj){
                exit(json(array('coed' => '1', 'msg' => '你没有权限操作这个动作！')));
            }else{
                exit('你没有权限访问这个文件！');
            }
        }
    }

    /**
     *  根据权限id获取下一级菜单
     * @author zhaojie
     */
    public function get_two_rule($role_id){
        $rule_list = Db::table("yl_admin_rule")
            ->field('rule_id,rule_name,rule_path,rule_parent')
            ->where(["rule_status"=>"Y","rule_parent"=>$role_id])
            ->order("rule_sort","asc")
            ->select();
        return $rule_list;
    }

    /**
     *  根据权限id获取下一级菜单,所有
     * @author zhaojie
     */
    public function get_all_rule($role_id){
        $rule_list = Db::table("yl_admin_rule")
            ->field('rule_id,rule_name,rule_path,rule_parent,rule_sort,rule_create_time,rule_status')
            ->where("rule_parent",$role_id)
            ->order("rule_sort","asc")
            ->select();
        return $rule_list;
    }

    //获取角色列表
    public function get_role_list(){
        $role_list = Db::table("yl_admin_author")
            ->field("author_id,author_name,author_status,author_probability")
            ->select();
        return $role_list;
    }

    //获取角色信息
    public function get_role_info($author_id){
        $role_list = Db::table("yl_admin_author")
            ->field("author_id,author_name,author_status,author_probability")
            ->where("author_id",$author_id)
            ->find();
        return $role_list;
    }
}
