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
class Brand extends Common
{
    public function index(){
        //连接数据库
        $brand = Db::table("shop_brand")
            ->order('brand_order', 'desc')
            ->paginate(2);
        return view('',["brand"=>$brand]);
    }
    public function add(){
        if (request()->isGet()){
            return view();
        }
        if($this->request->isPost()){
            //接值
            $data = input("post.");
            //var_dump($data); exit;
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('brand_logo');
            //var_dump($file); exit();
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file->move( 'uploads/brand');
            if($info){
                $data["brand_logo"] = $info->getSaveName();
            }else{
                echo $file->getError();
            }
            //添加
            $brandModel = new \app\admin\model\Brand();
            if($brandModel->addBrand($data)){
                $this->success("添加成功",'index');
            }else{
                $this->error("添加失败");
            }

        }
    }
}