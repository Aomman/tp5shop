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


use app\index\validate\Admin;
use think\captcha\Captcha;
use think\Controller;
use think\Db;
class Login extends Controller
{
    public function show()
    {
        //判断接值方式
        if(request()->isGet()){
            return view();
        }
        if(request()->isPost()){
            //接值
            $admin_name = request()->post("admin_name","");
            $admin_pwd = md5(request()->post("admin_pwd",""));
            $code = request()->post("code","");
//            var_dump($code);
//            //验证
//            $captcha = new Captcha();
//            if(!$captcha->check($code))
//            {
//                $this->error('验证码错了');
//            }
//            $data=[
//                'admin_name'=>$admin_name,
//                'admin_pwd'=>$admin_pwd
//            ];
//            //验证
//            $admin_validate = new Node();
//            if(!$admin_validate->check($data)){
//                echo $admin_validate->getError();
//            }
            //连接数据库
            $admin = Db::table("shop_admin")
                ->field(["admin_id","admin_name"])
                ->where("admin_name",$admin_name)
                ->where("admin_pwd",$admin_pwd)
                ->find();
            if($admin){
                //存session
                session("admin",$admin);
                $this->success("登录成功","Index/show");
            }else{
                $this->error("登录失败");
            }

        }
    }
    //退出登录
    public function logout()
    {
        session(null);
        $this->success("退出登录成功","show");
    }
    //验证码
    public function code(){
        $captcha=new Captcha();
        return $captcha->entry();
    }
}
