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
        if (request()->isGet()){
            return view();
        }
    }
    public function add(){
        if (request()->isGet()){
            return view();
        }
    }
}