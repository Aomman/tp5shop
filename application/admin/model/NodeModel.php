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

use app\admin\controller\Node;
use think\Db;
use think\Model;

class NodeModel extends Model
{
    public function getNodeAll()
    {
        $admin = Db::table("shop_admin")->select();
        return $admin;
    }
    public function getAdminNode(){
        $admin = Db::table('shop_admin')
            ->leftJoin('shop_node','shop_admin.admin_id = shop_node.node_id')
            ->select();
        return $admin;
    }
    public function getNode()
    {
        $node = Db::table("shop_node")->select();
        return $this->getCateByRecursion($node);
    }

    public function getCateByRecursion($node, $pid = 0, $level = 0)
    {
        $orderCate = [];
        foreach ($node as $key => $value) {
            if ($value["node_pid"] == $pid) {
                $value["level"] = $level;
                $orderCate[] = $value;
                $orderCate = array_merge($orderCate, $this->getCateByRecursion($node, $value["node_id"], $level + 1));
            }
        }
        return $orderCate;
    }
}