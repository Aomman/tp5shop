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
use app\index\validate\Admin;
use think\captcha\Captcha;
use think\Controller;
use think\Db;
use think\Validate;
class Cate extends Common
{
    public function index(){
        //判断接值方式
        if (request()->isGet()) {
            $cate=new CateModel();
            $cates=$cate->getCateAll();
//            var_dump($cates);exit();
            return view("",["cates"=>$cates]);
        }
    }
    public function append(){
        if (request()->isGet()) {
            $cate=new CateModel();
            $cates=$cate->getCateAll();
//            var_dump($cates);exit();
            return view("",["cates"=>$cates]);
        }
        if(request()->isPost()){
            //接值
//            $cate_name = request()->post("cate_name","");
//            $cate_isshow = request()->post("cate_isshow","");
            $data = input("post.");
//            var_dump($data);exit();
            //连接数据库
            $res = Db::table('shop_cate')
                ->data($data)
                ->insert();
            if($res){
                $this->success("添加分类成功","cate/show");
            }else{
                $this->error("添加失败");
            }
        }
    }

}