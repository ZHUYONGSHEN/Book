<?php
namespace Admin\Model;
use Think\Model\ViewModel;

class HouseResourceViewModel extends ViewModel {
    protected $tableName = 'house_resource';
    protected $pk = 'HouseResource.add_time';

    public $viewFields = array(     
        'HouseResource' => array(
            'id', 
            'hid', 
            'house_description', 
            'house_tips', 
            'house_from', 
            'audit_status', 
            'lbs_address' => 'detail_address', 
            'id','house_name','house_title', 
            'CONCAT(HouseResource.house_building,HouseResource.house_cell)' => 'house_building', 
            'floor','total_floor' => 'hrtotal_floor', 
            'room_no', 
            'CONCAT(room_count,hall_count,toilet_count)' => 'household', 
            'orientation', 
            'area', 
            'sell_price', 
            'FROM_UNIXTIME(UNIX_TIMESTAMP(add_time), "%Y-%m-%d %H:%i")' => 'add_time', 
            "house_certificate", 
            'owner_id_card', 
            'owner_delegation', 
            '_type' => 'LEFT'
        ),     
        'User' => array(
            'mobile' => 'user', '_on' => 'HouseResource.user_id=User.id', '_table' => 'pano_user', '_type' => 'LEFT'
        ), 
        // 'ResourcePhoto' => array(
        //     'img_4k' => 'head_url', '_on' => 'HouseResource.id=ResourcePhoto.rid', '_table' => 'pano_resource_photo', '_type' => 'LEFT'
        // ),
    );
}