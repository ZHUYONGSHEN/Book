<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Think\Cache\Driver;
use Think\Cache;
defined('THINK_PATH') or exit();

/**
 * Redis缓存驱动 
 * 要求安装phpredis扩展：https://github.com/nicolasff/phpredis
 */
class Redis extends Cache {

	
	/**
	 * 架构函数
     * @param array $options 缓存参数
     * @access public
     */
    public function __construct($options=array()) {
    	
        if ( !extension_loaded('redis') ) {
            E(L('_NOT_SUPPERT_').':redis');
        }
        
        if(empty($options)) {
        	
            $options = array (
                'host'          => C('REDIS_HOST') ? C('REDIS_HOST') : '127.0.0.1',
                'port'          => C('REDIS_PORT') ? C('REDIS_PORT') : 6379,
                'timeout'       => C('REDIS_TIMEOUT') ? C('REDIS_TIMEOUT') : false,
                'persistent'    => C('REDIS_PERSISTENT') ? C('REDIS_PERSISTENT') : false,
            );
            
        }
        
        $this->options =  $options;
        $this->options['expire'] =  isset($options['expire'])?  $options['expire']  :   C('REDIS_EXPIRE');
        $this->options['prefix'] =  isset($options['prefix'])?  $options['prefix']  :   C('REDIS_PREFIX');        
        $this->options['length'] =  isset($options['length'])?  $options['length']  :   0;        
        $func = $options['persistent'] ? 'pconnect' : 'connect';
        $this->handler  = new \Redis;

       	if($options['timeout'] === false ){
       		$this->handler->$func($options['host'], $options['port']) ;
       	}else {
       		$this->handler->$func($options['host'], $options['port'], $options['timeout']);
       	}
          
        //授权
     	$instanceid = C('REDIS_INSTANCEID'); //云服务实例id
        $instanceid_pwd = C('REDIS_INSTANCEID_PWD'); //云服务实例 密码
        
        $instanceid_auth = '';
        if (C('REDIS_PWD')){
        	$instanceid_auth = C('REDIS_PWD') ;//redis 密码
        }elseif (!empty($instanceid) && !empty($instanceid_pwd)){
        	$instanceid_auth = $instanceid.":".$instanceid_pwd;
        }
        
        $handler_auth = isset($options['pwd']) ? $options['pwd'] : $instanceid_auth ;//如果传了密码进来 ,则用
        
        if ($handler_auth){
        	if ($this->handler->auth($handler_auth) == false){
        		die($this->handler->getLastError());
        	}
        }
        
    }

    /**
     * 读取缓存
     * @access public
     * @param string $name 缓存变量名
     * @return mixed
     */
    public function get($name) {
        N('cache_read',1);
        $value = $this->handler->get($this->options['prefix'].$name);
        $jsonData  = json_decode( $value, true );
        return ($jsonData === NULL) ? $value : $jsonData;	//检测是否为JSON数据 true 返回JSON解析数组, false返回源数据
    }

    /**
     * 写入缓存
     * @access public
     * @param string $name 缓存变量名
     * @param mixed $value  存储数据
     * @param integer $expire  有效时间（秒）
     * @return boolean
     */
    public function set($name, $value, $expire = null) {
        N('cache_write',1);
        if(is_null($expire)) {
            $expire  = (int) $this->options['expire'];
        }
        $name   =   $this->options['prefix'].$name;
        //对数组/对象数据进行缓存处理，保证数据完整性
        $value  =  (is_object($value) || is_array($value)) ? json_encode($value) : $value;
        
        if(is_int($expire)) {
        	
            $result = $this->handler->setex($name, $expire, $value);
        }else{
        	
            $result = $this->handler->set($name, $value);
        }
        if($result && $this->options['length']>0) {
            // 记录缓存队列
            $this->queue($name);
        }
        return $result;
    }

    
    /**
     * 条件形式设置缓存，如果 key 不存时就设置，存在时设置失败
     * @param string $name
     * @param string $value
     */
    public function setnx($name,$value,$expire=NULL){
    	
    	$old_value = $this->get($name);
    	if (empty($old_value)){
    		return $this->set($name, $value,$expire);
    	}else {
    		return  false ;
    	}
    	
    }
    
    
    /**
     * 模糊匹配出缓存中的keys值
     * @param unknown $mates 匹配   可以是诸如 'aa' , 'aa*' , 'a*a*' , '?a' 等形式
     * 返回相应的keys值
     */
    public function keys($mates){
    	
    	$prefix = $this->options['prefix'] ;
    	$keyword = '' ;
    	if (empty($mates)){
    		$keyword = $prefix.'*';
    	}else {
    		$keyword = $prefix.$mates ;
    	}
    	return $this->handler->keys($keyword);
    }
    
    
    /* public function getkeys($mates){
    	$this->handler->getK
    } */
    
    
    
    
   /** 
    * 值加加操作,类似 ++$i ,如果 key 不存在时自动设置为 0 后进行加加操作
    * 只对数字有效
    *
    * @param string $key 缓存KEY
    * @param int $default 操作时的默认值
    * @return int　操作后的值
    */
    public function incr($key,$default=1){
    	if($default == 1){
    		return $this->handler->incr($this->options['prefix'].$key);
    	}else{
    		return $this->handler->incrBy($this->options['prefix'].$key, $default);
    	}
    }
    
    
    
    /**
     * 值减减操作,类似 --$i ,如果 key 不存在时自动设置为 0 后进行减减操作
     * 只对数字有效
     *
     * @param string $key 缓存KEY
     * @param int $default 操作时的默认值
     * @return int　操作后的值
     */
    public function decr($key,$default=1){
    	if($default == 1){
    		return $this->handler->decr($this->options['prefix'].$key);
    	}else{
    		return $this->handler->decrBy($this->options['prefix'].$key, $default);
    	}
    }
    
    
    /**
     * 删除缓存
     * @access public
     * @param string $name 缓存变量名
     * @return boolean
     */
    public function rm($name) {
        return $this->handler->delete($this->options['prefix'].$name);
    }

    /**
     * 清除缓存
     * @access public
     * @return boolean
     */
    /* public function clear() {
        return $this->handler->flushDB();
    }
     */
    
    
    
    /**
     * 判断key是否存在
     * @param string $key
     * @return boolean
     */
    public function exists($key) {
    	return $this->handler->exists($this->options['prefix'].$key);
    }
    
    /**
     * 得到一个key的生存时间
     * @param string $key
     * @return integer
     */
    public function ttl($key) {
    	return $this->handler->ttl($this->options['prefix'].$key);
    }
    
    /**
     * 在名称为key的list左边（头）添加一个值为value的 元素
     * @param string $key
     * @param mixed $value
     */
    public function lPush($key,$value) {
    	return $this->handler->lPush($this->options['prefix'].$key,$value);
    }
    
    /**
     * 在名称为key的list右边（尾）添加一个值为value的 元素
     * @param string $key
     * @param mixed $value
     */
    public function rPush($key,$value) {
    	return $this->handler->rPush($this->options['prefix'].$key,$value);
    }
    
    /**
     * 输出名称为key的list左(头)起/右（尾）起的第一个元素，删除该元素
     * @param string $key
     */
    public function lPop($key) {
    	return $this->handler->lPop($this->options['prefix'].$key);
    }
    
    /**
     * 返回名称为key的list中index位置的元素
     * @param string $key
     * @param integer $index
     * @return string
     */
    public function lGet($key,$index){
    	return $this->handler->lGet($this->options['prefix'].$key,$index);
    }
    
    /**
     * 给名称为key的list中index位置的元素赋值为value
     * @param string $key
     * @param integer $index
     * @param mixed $value
     * @return string
     */
    public function lSet($key,$index,$value) {
    	return $this->handler->lSet($this->options['prefix'].$key,$index,$value);
    }
    
    /**
     * 返回名称为key的list中start至end之间的元素（end为 -1 ，返回所有）
     * @param string $key
     * @param int $start
     * @param int $end
     * @return array
     */
    public function lrange($key,$start,$end) {
    	return $this->handler->lGetRange($this->options['prefix'].$key,$start,$end);
    }
    
    /**
     * 截取名称为key的list，保留start至end之间的元素
     * @param string $key
     * @param integer $start
     * @param integer $end
     * @return boolean 
     */
    public function lTrim($key,$start,$end) {
    	return $this->handler->ltrim($this->options['prefix'].$key,$start,$end);
    }
    
    /**
     * 删除key，支持数组批量删除【返回删除个数】
     * @param string $key
     */
    public function del($key) {
    	return $this->handler->del($this->options['prefix'].$key);
    }
    
    
    /**
     * 批量删除
     * @param unknown $mates 匹配   可以是诸如 'aa' , 'aa*' , 'a*a*' , '?a' 等形式
     * 返回删除keys的数目
     */
    public function delkeys($mast){
    	$keys_arr = $this->keys($mast);
    	$del_count = 0 ;
    	foreach ($keys_arr as $k =>$v){
    		$res = $this->handler->del($v);
    		if ($res){
    			$del_count ++ ;
    		}
    	}

    	return $del_count ;
    }
    
    
    
    /**
     * 设置缓存过期时间.
     * @param unknown $key
     * @param unknown $expire
     */
  	public function expire($key,$expire){
  		if (empty($expire) && !is_numeric($expire)){
  			$expire = (int) $this->options['expire'];
  		}
  		return $this->handler->expire($this->options['prefix'].$key, $expire);
  	}

  	/**
  	 * 设置过期时间
  	 * @param unknown $key
  	 * @param integer $timestamp 时间戳
  	 */
  	public function expireat($key,$timestamp){
  		if (is_numeric($timestamp)){
  			return $this->handler->expireAt($this->options['prefix'].$key, $timestamp);
  		}
  		
  	}
  	
  	
  	
   /**
    * 将哈希表key中的域field的值设为value。如果key不存在，一个新的哈希表被创建并进行HSET操作
    * @param string $key
    * @param unknown $field
    * @param unknown $value
    * @return 如果field是哈希表中的一个新建域，并且值设置成功，返回1。如果哈希表中域field已经存在且旧值已被新值覆盖，返回0
    */
    public function hSet($key,$field,$value){
    	return $this->handler->hSet($this->options['prefix'].$key,$field,$value);
    }
    
    
    /**
     * 将哈希表key中的域field的值设置为value，当且仅当域field不存在。若域field已经存在，该操作无效
     * @param string $key
     * @param unknown $field
     * @param unknown $value
     * @return 设置成功，返回1。如果给定域已经存在且没有操作被执行，返回0
     */
    public function hsetnx($key,$field,$value){
    	return $this->handler->hSetNx($this->options['prefix'].$key,$field,$value);
    }
    
    /**
     * 返回哈希表key中给定域field的值。
     * @param string $key
     * @param unknown $field
     * @return 给定域的值
     */
    public function hget($key,$field){
    	return $this->handler->hGet($this->options['prefix'].$key,$field);
    }
    
    
    /**
     * 同时将多个field - value(域-值)对设置到哈希表key中。此命令会覆盖哈希表中已存在的域。
     * @param unknown $key
     * @param unknown $kv_arr 键值对数组
     */
    public function hmset($key,$kv_arr){
    	return $this->handler->hMset($this->options['prefix'].$key,$kv_arr);
    
    }
    
   /**
    * 返回哈希表key中，一个或多个给定域的值
    * @param unknown $key
    * @param unknown $field_arr 键值对数组
    * 一个包含多个给定域的关联值的表，表值的排列顺序和给定域参数的请求顺序一样
    */
    public function hmget($key,$field_arr){
    	return $this->handler->hMget($this->options['prefix'].$key,$field_arr);
    }
    
    
    /**
     * 返回哈希表key中，所有的域和值。
     * 在返回值里，紧跟每个域名(field name)之后是域的值(value)，所以返回值的长度是哈希表大小的两倍。
     * @param unknown $key
     */
    public function  hgetall($key){
    	return $this->handler->hGetAll($this->options['prefix'].$key);
    }
    
    
    /**
     * 删除哈希表key中的一个或多个指定域，不存在的域将被忽略
     * @param string $key
     * @param array/string $field_arr 
     * @return integer 被成功移除的域的数量，不包括被忽略的域
     */
    public function  hdel($key,$field_arr){
    	$del_count = 0 ;
    	
    	if(is_array($field_arr)){
    		foreach ($field_arr as $k =>$v){
    			$this->handler->hDel($this->options['prefix'].$key,$v);
    			$del_count ++ ;
    		}
    		return $del_count ;
    		
    	}else {
    		
    		return $this->handler->hDel($this->options['prefix'].$key,$field_arr);
    	}
    	
    }
    
    
    /**
     * 返回哈希表key中域的数量。
     * @param string $key  hash表名
     */
    public function hlen($key){
    	return $this->handler->hLen($this->options['prefix'].$key);
    }
    
    
    /**
     * 查看哈希表key中，给定域field是否存在。
     * @param unknown $key
     * @param unknown $field
     */
    public function hExists($key,$field){
    	return $this->handler->hExists($this->options['prefix'].$key,$field);
    }
    
    
    /**
     * 返回哈希表key中的所有域。
     * @param unknown $key
     */
    public function hkeys($key){
    	return $this->handler->hKeys($this->options['prefix'].$key);
    }
    

    /**
     * 标记一个事务块的开始。
     */
    public  function multi(){
    	$this->handler->multi();
    }
    
    
    /**
     * 执行所有事务块内的命令
     */
    public  function exec(){
    	$this->handler->exec();
    }
    
    
    /**
     * 事务处理中的取消操作.
     */
    public  function  discard(){
    	$this->handler->discard();
    }

    /**
     * 清空所有的redis信息
     */
    public function flushDb()
    {
        $this->handler->flushDB();
    }
    
}
