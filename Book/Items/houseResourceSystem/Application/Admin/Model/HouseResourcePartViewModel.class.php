<?php
namespace Admin\Model;
use Think\Model\ViewModel;

class HouseResourcePartViewModel extends ViewModel {
    protected $tableName = 'house_resource';
    protected $pk = 'HouseResource.add_time';

    public $viewFields = array(     
        'HouseResource' => array(
            '_type' => 'LEFT'
        ),
        // 'ResourcePhoto' => array(
        //     'img_4k' => 'head_url', '_on' => 'HouseResource.id=ResourcePhoto.rid', '_table' => 'pano_resource_photo', '_type' => 'LEFT'
        // ),
        'Dictionary' => array(
            'CONCAT(province,city,district)' => 'address', 'management_price', 'house_use', 'build_type', 'build_year', '_on' => 'Dictionary.hid=HouseResource.hid', '_type' => 'LEFT'
        ),
        'HouseFrame' => array(
            'CONCAT(stair,"梯",household,"户")' => 'stair_household', 'total_floor' => 'hftotal_floor', '_type' => 'LEFT', '_on' => 'HouseFrame.hfid=HouseResource.hfid', '_table' => 'pano_house_frame'
        )
    );
}