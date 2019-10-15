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
class Node extends Common
{
    public function show(){
        if (request()->isGet()){
            $admin=new NodeModel();
            $admin=$admin->getNodeAll();
//            var_dump($admin);exit();
            return view("",["admin"=>$admin]);
        }
    }
    public function add(){
        if (request()->isGet()){
            return view();
        }
        if(request()->isPost()){
//            $data = input("post.");
            $admin_name=request()->post("admin_name");
            $admin_email=request()->post("admin_email");
            $admin_pwd=md5(request()->post("admin_pwd"));
            $add_time = time();
            $last_login = time()+$add_time;
            $data=["admin_name"=>$admin_name,"admin_email"=>$admin_email,"admin_pwd"=>$admin_pwd,"add_time"=>$add_time,"last_login"=>$last_login];
            //连接数据库
            $res = Db::table('shop_admin')
                ->data($data)
                ->insert();
            if($res){
                $this->success("添加分类成功","node/show");
            }else{
                $this->error("添加失败");
            }
        }
    }
    public function node(){
        if (request()->isGet()){
            $node = new NodeModel();
            $node = $node->getNode();
            return view("",["node"=>$node]);
        }
    }
    public function node_add(){
        if (request()->isGet()){
            $node = new NodeModel();
            $node = $node->getNode();
            return view("",["node"=>$node]);
        }
        if(request()->isPost()){
            $data = input("post.");
//            var_dump($data);exit();
            //连接数据库
            $res = Db::table('shop_node')
                ->data($data)
                ->insert();
            if($res){
                $this->success("添加分类成功","node/node");
            }else{
                $this->error("添加失败");
            }
        }
    }
    public function role(){
        if (request()->isGet()){
            $admin = new NodeModel();
            $admin = $admin->getAdminNode();
            return view("",["admin"=>$admin]);
        }
    }
    public function role_add(){
        if (request()->isGet()){
            $node = new NodeModel();
            $node = $node->getNode();
            var_dump($node); exit();
            return view("",["node"=>$node]);
        }
        if (request()->isPost()){
            $admin_name = request()->post("admin_name");
            $node_id = request()->post("node_name");
            $node_id = implode(",",$node_id);
            $data = ["admin_name"=>$admin_name,"node_id"=>$node_id];
//            var_dump($data); exit();
            $res = Db::table('shop_admin')
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