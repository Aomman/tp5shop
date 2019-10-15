<?php

namespace app\admin\model;

use think\Model;

class Brand extends Model
{
    public $pk="brand_id";
    public  static function getAllCate(){
        return self::all();
    }
    public function addBrand($data){
        return $this->save($data);
    }
}
