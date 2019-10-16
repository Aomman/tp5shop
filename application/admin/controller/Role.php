<?php
namespace app\admin\controller;

use app\admin\model\Node;
use app\admin\model\RoleNode;
use app\admin\service\NodeService;
use think\Controller;
use think\facade\Session;
use think\validate\ValidateRule;

class Role extends Common{
    public function show(){
        $role=(new \app\admin\model\Role())->all();
        return view('',["role"=>$role]);
    }

    //添加角色
    public function add(){
        if(request()->isGet()){
            $nodeModel=new Node();
            $nodeService=new NodeService();
            $nodeTree=$nodeService->getNodeTree($nodeModel->all());
            return view("",["nodeTree"=>$nodeTree]);
        }
        if(request()->isPost()){
            $roleModel=new \app\admin\model\Role();
            $roleModel->role_name=request()->post("role_name");
            $roleModel->save();
            if(request()->post("node_id")){
                $roleModel->node()->saveAll(request()->post("node_id"));
            }
            $this->success("添加角色成功");
        }
    }
    public function update(){
        echo "我是角色修改";
    }
    public function delete(){
        echo "我是角色删除";
    }
}
