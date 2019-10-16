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
            $node = new NodeModel();
            $node = $node->getNode();
            return view("",["node"=>$node]);
        }
    }
    public function add(){
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
                $this->success("添加分类成功","node/show");
            }else{
                $this->error("添加失败");
            }
        }
    }
}