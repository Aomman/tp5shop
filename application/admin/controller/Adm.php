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

use app\admin\model\Role;
use think\Controller;
use think\facade\Session;
use think\validate\ValidateRule;

class Adm extends Common{
    public function show(){
        $admin=(new \app\admin\model\Admin())->all();
        return view('',["admin"=>$admin]);
    }
    //添加管理员
    public function add(){
        if (request()->isGet()){
            $role=(new Role())->all();
            return view('',["role"=>$role]);
        }
        if(request()->isPost()){
          $adminModel=new \app\admin\model\Admin();
            $adminModel->admin_name=request()->post("admin_name");
            $adminModel->admin_pwd=md5(request()->post("admin_pwd"));
            $adminModel->add_time=time();
            $adminModel->save();
            $adminModel->role()->saveAll(request()->post("role_id"));
            $this->success("添加管理员成功",'show');
        }
    }
}