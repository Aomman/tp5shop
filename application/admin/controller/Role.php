<?php
/**
 * User:邓邓
 *  .--,       .--,
 *  * ( (  \.---./  ) )
 *  *  '.__/o   o\__.'
 *  *     {=  ^  =}
 *  *      >  -  <
 *  *     /       \
 *  *    //       \\
 *  *   //|   .   |\\
 *  *   "'\       /'"_.-~^`'-.
 *  *      \  _  /--'         `
 *  *    ___)( )(___
 *  *   (((__) (__)))
 * 别出bug
 */
namespace app\admin\controller;
use app\admin\model\CateModel;
use app\admin\model\NodeModel;
use app\index\validate\Admin;
use think\captcha\Captcha;
use think\Controller;
use think\Db;
use think\Validate;
class Role extends Common
{
    public function show(){
        if (request()->isGet()){
            $admin = new NodeModel();
            $admin = $admin->getAdminNode();
            return view("",["admin"=>$admin]);
        }
    }
    public function add(){
        if (request()->isGet()){
            $node = new NodeModel();
            $node = $node->getNode();
//            var_dump($node); exit();
            return view("",["node"=>$node]);
        }
        if (request()->isPost()){
            $role_name = request()->post("role_name");
            $node_id = request()->post("node_name");
            $node_id = implode(",",$node_id);
            $data = ["role_name"=>$role_name,"node_id"=>$node_id];
//            var_dump($data); exit();
            $res = Db::table('shop_role')
                ->data($data)
                ->insert();
            if($res){
                $this->success("添加角色成功","node/role");
            }else{
                $this->error("添加失败");
            }
        }
    }
}