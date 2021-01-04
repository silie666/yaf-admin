<?php


namespace Silie\Model\Admin;


use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public static function getList($params){
        $where[] = array('id','neq',0);
        if(!empty($params['user_nickname'])){
            $where[] = array('user_nickname','like',"%{$params['user_nickname']}%");
        }
        if(!empty($params['user_type'])){
            $where[] = array('user_type','eq',$params['user_type']);
        }
        if(isset($params['forbid_publish'])&&!empty($params['forbid_publish'])){
            $where[] = array('forbid_publish','eq',$params['forbid_publish']);
        }

        if($params['start_time']){
            $where[] = ['create_time','gt', $params['start_time']];
        }
        if($params['end_time']){
            $where[] = ['create_time','lt', $params['end_time']];
        }

        $m = self::where($where)->order('id desc');
        $data['list'] = $m->page($params['page'],$params['limit'])->select();
        $data['count'] = $m->count();
        return $data;
    }


    public static function edit($data){
        $model = new self();
        if($data['id']){
            $model->isUpdate(true)->allowField(true)->save($data);
            return $data['id'];
        }else{
            $model->isUpdate(false)->allowField(true)->save($data);
            return $model->id;
        }
    }

    /**
      * Author: Silie
      * Date: 2020-12-31 11:17:53
      * Description: 获取详情
      */
    public static function detail($id){
        return self::where('id',$id)->find();
    }


    /**
      * Author: Silie
      * Date: 2020-12-31 11:19:41
      * Description: 删除
      */
    public static function del($params){
        $is_show = $params['status']?1:0;
        $obj = new self();
        $map[] = array('id', 'in', $params['ids']);
        return $obj->save(array('user_status'=>$is_show),$map);
    }

}