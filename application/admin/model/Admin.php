<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Admin extends Model{
    protected $pk="admin_id";
    public function role(){
        return $this->belongsToMany('Role',"admin_role","role_id","admin_id");
    }
}