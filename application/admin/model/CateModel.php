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

namespace app\admin\model;

use think\Db;
use think\Model;

class CateModel extends Model
{
    public function getCateAll()
    {
        $cates = Db::table("shop_cate")->select();
        return $this->getCateByRecursion($cates);
    }

    public function getCateByRecursion($cate, $pid = 0, $level = 0)
    {
        $orderCate = [];
        foreach ($cate as $key => $value) {
            if ($value["cate_pid"] == $pid) {
                $value["level"] = $level;
                $orderCate[] = $value;
                $orderCate = array_merge($orderCate, $this->getCateByRecursion($cate, $value["cate_id"], $level + 1));
            }
        }
        return $orderCate;
    }
}