<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Role extends Model{
    protected $pk="role_id";

    public function node(){
        return $this->belongsToMany("Node",'node_role',"node_id","role_id");
    }
}