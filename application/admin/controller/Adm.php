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
class Adm extends Common
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
            $node = new NodeModel();
            $node = $node->getNode();
            return view("",["node"=>$node]);
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
}