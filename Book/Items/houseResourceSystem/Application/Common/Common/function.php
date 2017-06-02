<?php

/**
 * 登录后写日志，不记录超级管理员 
 */
function writeLog($note = '') {
    $_Log = D('Log');
    $data = array(
        'model' => CONTROLLER_NAME,
        'action' => ACTION_NAME,
        'admin_id' => (int) session(C('USER_AUTH_KEY')),
        'note' => $note,
        'ip' => get_client_ip(),
        'create_time' => time(),
    );
    $_Log->add($data);
}

/**
  +----------------------------------------------------------
 * 把返回的数据集转换成Tree
  +----------------------------------------------------------
 * @access public
  +----------------------------------------------------------
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
  +----------------------------------------------------------
 * @return array
  +----------------------------------------------------------
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = & $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $list[$key]['level'] = 1;
                $tree[] = & $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = & $refer[$parentId];
                    $list[$key]['hasChild'] = 0;
                    $list[$key]['level'] = $parent['level'] + 1;
                    $parent['hasChild'] = 1;
                    $parent[$child][] = & $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 *
 * 还原树形数组为普通数组
 * 
 * @param type $tree
 * @param type $list
 * @param type $child
 * @return type 
 */
function tree_to_list($tree, $list = array(), $child = '_child') {
    if (is_array($tree)) {
        foreach ($tree as $key => $data) {
            $item = $data;
            if (isset($data[$child])) {
                unset($item[$child]);
                $list[] = $item;
                $list = tree_to_list($data[$child], $list);
            } else {
                $list[] = $item;
            }
        }
    }
    return $list;
}

/**
 * 用于将层级列表按顺序排列
 * 
 * @param type $list
 * @param type $root
 * @param type $pk
 * @param type $pid
 * @param type $child
 * @return type 
 * @author Panxiaoming 2011-11-10
 */
function list_to_level($list, $root = 0, $pk = 'id', $pid = 'pid', $child = '_child') {
    $tree = list_to_tree($list, $pk, $pid, $child, $root);
    $list = tree_to_list($tree);
    return $list;
}

/**
 * 获取缓存数据内容，未有缓存则生成缓存，命名“~小写数据表名”
 * 
 * @param type $id
 * @param type $model 数据表名，首字母大写
 * @param type $field
 * @return string 
 */
function getDataName($id, $model = 'Catalog', $field = 'name') {
    if ($id == 0) {
        return '';
    }


    $_Model = D($model);
    $pk = $_Model->getPk();
    $list = $_Model->where("$pk='" . $id . "'")->getField("{$pk},{$field}");


    if (isset($list[$id]))
        return $list[$id];
    else
        return array();
}

/**
 * 获取多个缓存数据内容，未有缓存则生成缓存，命名“~小写数据表名”
 * 
 * @param type $ids 用,连接，如：1,2,3
 * @param type $model 数据表名，首字母大写
 * @param type $field
 * @return string 
 */
function getDataNames($ids, $model = 'Catalog', $field = 'name') {
    if (empty($ids)) {
        return '无';
    }

    $_Model = M($model);
    $pk = $_Model->getPk();
    $map[$pk] = array('in', $ids);
    $list = $_Model->where($map)->getField("{$pk},{$field}");

    $ids = explode(',', $ids);
    foreach ($ids as $id) {
        $result[] = $list[$id];
    }

    return implode('; ', $result);
}

/**
 * 获取权限级别名称
 * 
 * @param type $level
 * @return string 
 */
function getNodeLevel($level) {
    switch ($level) {
        case 1:
            $levelName = '组';
            break;
        case 2:
            $levelName = '模块';
            break;
        case 3:
            $levelName = '操作';
            break;
        default:
            $levelName = '未定义';
            break;
    }
    return $levelName;
}

/**
 * 获取数据状态信息，可选择文字或图片
 * 
 * @param type $status
 * @param type $imageShow
 * @return type 
 */
function getStatus($status, $imageShow = false) {
    switch ($status) {
        case 0:
            $showText = '禁用';
            $showImg = '<img src="/Public/Admin/images/no.png" border="0" alt="禁用">';
            break;
        case 1:
        default:
            $showText = '启用';
            $showImg = '<img src="/Public/Admin/images/ok.png" border="0" alt="启用">';
    }
    return ($imageShow === true) ? ($showImg) : $showText;
}

/**
 * 获取分级前缀
 * 
 * @param type $level
 * @return type 
 */
function getSubPrefix($level) {
    $pre = '';
    if ($level > 1) {
        $pre .= '&nbsp;&nbsp;';
    }
    $pre .= str_repeat('&nbsp;&nbsp;', $level - 1);
    return $pre;
}

function showSubRoute($route = '') {
    if (!empty($route)) {
        $tmp = explode('-', $route);
        $tmp = array_map('_addSub', $tmp);
        return implode(' ', $tmp);
    } else {
        return;
    }
}

function _addSub($route) {
    return 'sub' . $route;
}

/**
 * 处理mysql记录中的null值
 * 
 * @param string $str
 * @return string 
 */
function dump_null_string($str) {
    if (!isset($str) || is_null($str)) {
        $str = 'NULL';
    }
    return $str;
}

/**
  +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
  +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 2 大写字母 3 小写字母 4中文 其它 混合
 * @param string $addChars 额外字符
  +----------------------------------------------------------
 * @return string
  +----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '') {
    $str = '';
    switch ($type) {
        case 0:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
            break;
        case 1:
            $chars = str_repeat('0123456789', 3);
            break;
        case 2:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
            break;
        case 3:
            $chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
            break;
        case 4:
            $chars = "们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借" . $addChars;
            break;
        default :
            // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
            $chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
            break;
    }
    if ($len > 10) {//位数过长重复字符串一定次数
        $chars = $type == 1 ? str_repeat($chars, $len) : str_repeat($chars, 5);
    }
    if ($type != 4) {
        $chars = str_shuffle($chars);
        $str = substr($chars, 0, $len);
    } else {
        // 中文随机字
        for ($i = 0; $i < $len; $i++) {
            $str.= msubstr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8') - 1)), 1);
        }
    }
    return $str;
}

/**
 * 获取特定上传信息的保存名字，若多于一个则返回数组，否则单一名称
 *
 * @param type $infos 所有上传信息
 * @param type $field 查找的控件名
 * @return mixed 数组或单一文件名
 */
function getUploadName($infos, $field = 'uploadphoto') {
    $photos = array();
    foreach ($infos as $key => $info) {
        //if($info['key'] == $field){
        $photos[$info['key']] = $info['savename'];
        //}
    }
    if (count($photos) > 1) {
        return $photos;
    } else {
        return $photos[0];
    }
}

/**
 * 生成下拉菜单
 */
function makeSelect($name, $selected_id, $module, $default_option = '--请选择--') {
    $list = D($module)->select();
    $html = "<div class=\"select_tong\"><select name='{$name}'>";
    $html .= '<option value="0">' . $default_option . '</option>';
    foreach ($list as $item) {
        if ($item['id'] == $selected_id) {
            $html .= '<option value="' . $item['id'] . '" selected>' . $item['name'] . '</option>';
        } else {
            $html .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
        }
    }
    $html .= "</select></div>";
    return $html;
}

/**
 * 生成下拉菜单
 */
function makeCheckBox($house_id, $name, $return_html = true) {
    static $list = array();
    static $HouseFacility;
    if (empty($list)) {
        $list = M('Facility')->select();
        $HouseFacility = M('HouseFacility');
    }
    $result = array();
    if (!empty($house_id)) {
        $cond['house_id'] = $house_id;
        $result = $HouseFacility->where($cond)->select();
    }
    $html = '';
    $selected_item_arr = array();
    foreach ($list as $row) {
        $html .= '<input type="checkbox" name="' . $name . '"';
        foreach ($result as $selected_row) {
            if ($selected_row['facility_id'] == $row['id']) {
                $html .= ' checked="checked"';
                $selected_item_arr[] = $row['name'];
                break;
            }
        }
        $html .= ' value="' . $row['id'] . '"> ' . $row['name'];
        $html .= str_repeat("&nbsp", 3);
    }
    return $return_html ? $html : $selected_item_arr;
}

function makeSelectGroup($name, $selected_id, $module, $default_option = '--请选择--') {
    $list = D($module)->order('sort DESC')->select();
    $list = list_to_level($list);
    $html = "<div class=\"select_tong\"><select name='{$name}'>";
    $html .= '<option value="0">' . $default_option . '</option>';
    foreach ($list as $item) {
        if ($item['pid'] == 0) {
            $html .= '<optgroup label="' . $item['name'] . '">';
            continue;
        }
        if ($item['id'] == $selected_id) {
            $html .= '<option value="' . $item['id'] . '" selected style="padding-left:10px;">  ' . $item['name'] . '</option>';
        } else {
            $html .= '<option value="' . $item['id'] . '" style="padding-left:10px;">  ' . $item['name'] . '</option>';
        }
    }
    $html .= "</select></div>";
    return $html;
}

function enumSelect($name, $selected_id, $module) {
    $Model = D($module);
    $table = $Model->getTableName();
    $res = $Model->query("SHOW FULL COLUMNS FROM $table");
    $html = "<div class=\"select_tong\"><select name='{$name}'>";
    foreach ($res as $value) {
        if ($value['Field'] == $name) {
            $type = $value['Type'];
            preg_match_all("/'[A-Za-z]+'/", $type, $out);
            foreach ($out[0] as $item) {
                $item = trim($item, "'");
                if ($item == $selected_id) {
                    $html .= '<option value="' . $item . '" selected>' . L($item) . '</option>';
                } else {
                    $html .= '<option value="' . $item . '">' . L($item) . '</option>';
                }
            }
        }
    }
    $html .= "</select></div>";
    return $html;
}

function enumRadio($name, $selected_id, $module) {
    $Model = D($module);
    $table = $Model->getTableName();
    $res = $Model->query("SHOW FULL COLUMNS FROM $table");
    $html = "<div class=\"select_tong\"><select name='{$name}'>";
    $html = '';
    foreach ($res as $value) {
        if ($value['Field'] == $name) {
            $type = $value['Type'];
            preg_match_all("/'[A-Z]+'/", $type, $out);
            foreach ($out[0] as $item) {
                $item = trim($item, "'");
                if ($item == $selected_id) {
                    $html .= '<label><input type="radio" class="radio-label" name="' . $name . '" value="' . $item . '" checked="checked">' . L($item) . '</label>';
                } else {
                    $html .= '<label><input type="radio" class="radio-label" name="' . $name . '" value="' . $item . '">' . L($item) . '</label>';
                }
            }
        }
    }
    $html .= "</select></div>";
    return $html;
}

function replace_content($content = '') {
    $content = preg_replace('/<img[^>]+\/>/', '[图片]', $content);
    $content = strip_tags($content);
    $content = htmlspecialchars($content);
    $dot = mb_strlen($content) > 100 ? '...' : '';
    $content = mb_substr($content, 0, 100) . $dot;
    return $content;
}

function getName($id, $model) {
    static $arr;
    if (!isset($arr[$model])) {
        $res = D($model)->field('id,name')->select();
        foreach ($res as $value) {
            $arr[$model][$value['id']] = $value['name'];
        }
    }
    return $arr[$model][$id];
}

function getUsername($ids) {
    $map['id'] = array('IN', $ids);
    $list = D('Member')->field('id,nickname')->where($map)->select();
    $user = array();
    foreach ($list as $value) {
        $user[] = $value['nickname'];
    }
    return implode("，", $user);
}

function is_pjax() {
    return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'];
}

function fb_log($var) {
    require_once('FirePHPCore/fb.php');
    FB::log($var);
}

function format_time() {
    return date('Y-m-d H:i:s');
}

function cut_str($string, $max = 50, $rep = '[...]') {
    $strlen = mb_strlen($string, 'utf-8');
    if ($strlen > $max) {
        $string = mb_substr($string, 0, $max, 'utf-8') . "...";
    }
    return $string;
    if ($strlen <= $max)
        return $string;

    $lengthtokeep = $max - mb_strlen($rep, 'utf-8');
    $start = 0;
    $end = 0;

    if (($lengthtokeep % 2) == 0) {
        $start = $lengthtokeep / 2;
        $end = $start;
    } else {
        $start = intval($lengthtokeep / 2);
        $end = $start + 1;
    }

    $i = $start;
    $tmp_string = $string;
    while ($i < $strlen) {
        if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
            $tmp_string = mb_substr($tmp_string, 0, $i) . $rep;
            $return = $tmp_string;
        }
        $i++;
    }

    $i = $end;
    $tmp_string = strrev($string);
    while ($i < $strlen) {
        if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
            $tmp_string = mb_substr($tmp_string, 0, $i);
            $return .= strrev($tmp_string);
        }
        $i++;
    }
    // return $return;
    return mb_substr($string, 0, $start) . $rep . mb_substr($string, - $end);
}

/**
 * 通过键值获取配置信息，未有缓存则生成缓存，命名“~小写数据表名_key
 * @param type $key
 * @param type $model 数据表名，首字母大写
 * @param type $field
 * @return string 
 */
function getAdminConfig($key, $model = 'Config') {
    if (!$list) {
        $_Model = D($model);
        $configList = $_Model->select();
        $list = array();
        foreach ($configList as $k => $v) {
            $list[$v['key']][] = $v;
        }
    }
    if ($key == '_All') {
        return $list;
    }
    if (isset($list[$key]))
        return $list[$key];
    else
        return array();
}

/**
 * 替换图片地址
 * @author wangxianlong
 * @param $loupanImageUrl string 楼盘在数据库中的地址
 * @param $absolute boolean 是否返回绝对地址
 * @return string
 */
function getLoupanImageUrl($loupanImageUrl, $absolute = false) {

    if ($absolute)
        return '/' . C('UPLOAD_FLOAD') . '/' . $loupanImageUrl;
}

/**
 * 获取用户的开发商或者代理商
 * @author wangxianlong
 * @param $id int 用户id
 * @return $info array $info['developer_id'],开发商id,$info['operate_id'],代理商id
 */
function getDeveloperAndOperate($id) {
    $Staff = D('OperateStaff');
    $staff = $Staff->find($id);
    $info = array();
    if ($staff['type'] == C('OPERATE_OPERATE_ROLE')) {
        //代理商
        if ($staff['role'] == C('OPERATE_ADMIN_ROLE')) {
            $info['operate_id'] = $id;
        } else {
            $info['operate_id'] = $staff['parent_id'];
        }
        $info['developer_id'] = 0; //如果是代理商，开发商的id为0
    } else {
        //代理商
        if ($staff['role'] == C('OPERATE_ADMIN_ROLE')) {
            $info['developer_id'] = $id;
            $info['operate_id'] = $staff['parent_id'];
        } else {
            $info['developer_id'] = $staff['parent_id'];
            $info['operate_id'] = $Staff->where("id='{$staff['parent_id']}")->getField('parent_id');
        }
    }

    return $info;
}

/**
 * 获取操作员开发商或者代理商的公司名称
 * @author wangxianlong
 * @param $staffId int 用户操作员id
 * @return string,公司名称
 */
function getCompanyOfName($staffId) {
    if (!$list) {
        $list = array();
    }

    if (!isset($list[$staffId]) || !$list[$staffId]) {
        $Staff = D('OperateStaff');
        $staff = $Staff->find($staffId);

        if ($staff['info_id']) {
            $StaffUserInfo = D('OperateUserInfo');
            $info = $StaffUserInfo->where("id='{$staff['info_id']}'")->getField('company'); //如果有完善公司名称，返回公司名称
        } else {
            $info = $staff['remark']; //没有公司名称，返回描述信息
        }
        $list[$staffId] = $info;
    }

    return $list[$staffId];
}

/**
 * 带前缀的语言
 * @author wangxianlong
 * @param $key string  键值
 * @param $prox string 前缀
 * @param $uper boolean 是否大写
 * @return string,语言包
 */
function _L($key, $uper = false, $prox = '') {
    $key = $prox . $key;

    if ($uper) {
        $key = strtoupper($key);
    }
    return L($key);
}

function getDataById($id, $model = 'Catalog', $field = 'name') {
    $_Model = D($model);
    $pk = $_Model->getPk();
    $value = $_Model->where("$pk='$id'")->getField("{$field}");
    return $value;
}

function makePassword($password, $hash) {
    return md5(md5($password) . $hash);
}

function qmyxStatus($status) {
    switch ($status) {
        case 1: $info = '新客户';
            break;
        case 2: $info = '已确认';
            break;
        case 3: $info = '已跟进';
            break;
        case 4: $info = '已到访';
            break;
        case 5: $info = '已认筹';
            break;
        case 6: $info = '已认购';
            break;
        case 7: $info = '已回复';
            break;
        case 8: $info = '失效客户';
            break;
        case 9: $info = '未成交';
            break;
    }
    return $info;
}

function makeMoney($money) {
    return 0 - $money;
}

function checkInString($item, $string) {

    if (in_array($item, explode(',', $string)))
        return true;
    else
        return false;
}

function getProvince() {
    $list = F('~' . strtolower('_Province_'));
    if (!$list) {
        $area = D('Area');
        $list = $area->where("level='1'")->select();
        F('~' . strtolower('_Province_'), $list);
    }
    return $list;
}

function checkAdcode($adcode, $checkAdcode, $level = 1) {
    if ($level == 1) {
        $check = substr($adcode, 0, 2) . '0000';
    }
    if ($check == $checkAdcode)
        return true;
    return false;
}

function getBuildingAdcode() {
    $zhixiashi = array('11', '12', '31', '50', '81', '82'); //直辖市开头
    $Building = D('Building');
    $adcodes = $Building->Distinct(true)->field('city')->getField('adcode', true);
    //处理获取城市adcode
    $cityCode = array();
    foreach ($adcodes as $key => $value) {
        if ($value) {

            if (in_array(substr($value, 0, 2), $zhixiashi)) {
                $cityCode[] = substr($value, 0, 2) . "0000";
            }
            $cityCode[] = substr($value, 0, 4) . '00';
        }
    }

    return array_unique($cityCode);
}

/**
 * 获取搜索类型
 */
function getComType($type) {
    $typeData = getAdminConfig($type);
    $apartMenttype = array();
    $apartMenttype[] = array(
        'id' => 0,
        'name' => '全部'
    );
    foreach ($typeData as $key => $value) {
        $apartMenttype[] = array(
            'id' => $value['id'],
            'name' => $value['value']
        );
    }
    return $apartMenttype;
}

function getPrice() {
    $type = getAdminConfig('_TYPE_PRICE_');
    $priceType = array();
    $priceType[] = array(
        'id' => 0,
        'name' => '全部'
    );
    foreach ($type as $key => $value) {
        $priceType[] = array(
            'id' => $value['id'],
            'name' => $value['value'] . '/㎡'
        );
    }
    return $priceType;
}

/**
 * 价格区间
 * @param Array $priceId
 * @return Array
 */
function handlePriceSelect($priceId) {
    $map['key'] = '_TYPE_PRICE_';
    $map['id'] = $priceId;
    $config = D('Config')->where($map)->find();
    $value = explode('~', $config['value']);
    return array(
        'max' => intval($value[1]) ? intval($value[1]) : 9999999,
        'min' => intval($value[0]) ? intval($value[0]) : 0
    );
}

/**
 * 根据ID获取配置
 * @param Int $id
 * @return String
 */
function getValueById($id) {
    $map['id'] = $id;
    $value = D('Config')->where($map)->getField('value');
    return $value;
}

function checkMobileCanUsed($mobile) {
    if (D('OperateUser')->where("account='" . $mobile . "'")->find())
        return false;
    if (D('OperateUserInfo')->where("mobile='" . $mobile . "'")->find())
        return false;
    return true;
}

function getSelfCompany($id) {
    $user = D('OperateUserView')->find($id);
    if ($user['company'])
        return $user['company'];
    else
        return $user['remark'];
}

function getHids($userid) {

    $Relation = D('BuildingRelation');
    $map['userid'] = $userid;
    $re = $Relation->where($map)->getField('hid', true);
    return $re;
}

function getChildPeople($userid) {
    $DefaultRole = C('DEFAULT_ROLE');
    $User = D('OperateUser');
    $user = $User->find($userid);
    $map['parent_id'] = $userid;
    $childs = array();
    $child_temp = $User->where($map)->getField('id', true);
    while (is_array($child_temp)) {
        $childs = array_merge($childs, $child_temp);
        $map['parent_id'] = array('in', $child_temp);
        $child_temp = $User->where($map)->getField('id', true);
    }
    return $childs;
}

function getDev($id) {
    $Dev = D('Dev');
    return $Dev->where("id='" . $id . "'")->getField('name');
}

function getCommissionByCustomer($id) {
    $account = D('EstateCommission')->where("customer_id='" . $id . "'")->getField('account');
    return intval($account);
}

/**
 * 记录用户操作
 * @param $uid
 * @param $title
 * @param bool $status
 * @return bool
 */
function writUserLogs($uid, $title, $status = true) {
    if (!$uid)
        return false;
    $data['action'] = CONTROLLER_NAME . '/' . ACTION_NAME;
    $data['uid'] = $uid;
    $data['title'] = $title;
    $data['at'] = NOW_TIME;
    $data['status'] = $status ? 1 : 0;

    $m = M('user_history');
    $m->add($data);
}

function sendsms($phone, $msg) {
    $Config = array(
        'app_id' => '163481820000038433',
        'app_secret' => 'f8a999e8f4bab144521dd51a1dd3c98f',
        'access_token' => '',
        'debug' => false,
    );

    Vendor('Tianyi.ChinaNetSMS');
    $SMS = new \Vendor\Tianyi\ChinaNetSMS($Config);
    $res = $SMS->sendSMS($phone, $msg, 10);
    if ($res) {
        return true;
    } else {
        //短信验证码发放失败
        return false;
    }
}

/**
 * 处理富文本编辑器内容
 * @param type $countent
 * @return type
 */
function appEditor($countent) {
    $str = <<<EOF
            <style>
            img{
                max-width:90%;
                width:auto;
                height:auto;
                margin:auto;
                display: block;
            }
            </style>
          
EOF;
    return $str . html_entity_decode($countent);
}

/**
 * @author xingcuntian
 * httpget 远程调用中原数据专用
 * @param type $requst_url
 * @return boolean
 */
function http_get_data($requst_url, $tag = true) {
    if (empty($requst_url)) {
        return false;
    }
    if ($tag) {
        $header[] = "appid:1001";
        $header[] = "appsecrect:61a059f02d74440eb73178e7da18382b";
    }
    $ch = curl_init(); //初始化curl
    curl_setopt($ch, CURLOPT_URL, $requst_url);  //设置选项，包括URL
    $tag and curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch); //执行并获取数据
    curl_close($ch); //释放curl句柄
    return json_decode($output, true);
}

/**
 * 单位转化
 * @param type $money
 * @return type
 */
function FormatMoney($money) {
    $money = sprintf("%.2f", $money / 10000);
    return substr($money, 0, -3);
}

/**
 * 判断操作系统位数
 */
function is_64bit() {
    $int = "9223372036854775807";
    $int = intval($int);
    if ($int == 9223372036854775807) {
        /* 64bit */
        return true;
    } elseif ($int == 2147483647) {
        /* 32bit */
        return false;
    } else {
        /* error */
        return "error";
    }
}

/**
 * 获取usersig
 * 36000为usersig的保活期
 * signature为获取私钥脚本 
 */
function getSignature() {
    if (is_64bit()) {
        if (PATH_SEPARATOR == ':') {
            $signature = "signature/linux-signature64";
        } else {
            $signature = "signature\\windows-signature64.exe";
        }
    } else {
        if (PATH_SEPARATOR == ':') {
            $signature = "signature/linux-signature32";
        } else {
            $signature = "signature\\windows-signature32.exe";
        }
    }
    return $signature;
}

/**
 * array_column 兼容低版本
 * @param type $input
 * @param type $columnKey
 * @param type $indexKey
 * @return type
 */
function field_array_column($input, $columnKey, $indexKey = null) {
    $columnKeyIsNumber = (is_numeric($columnKey)) ? true : false;
    $indexKeyIsNull = (is_null($indexKey)) ? true : false;
    $indexKeyIsNumber = (is_numeric($indexKey)) ? true : false;
    $result = array();
    foreach ((array) $input as $key => $row) {
        if ($columnKeyIsNumber) {
            $tmp = array_slice($row, $columnKey, 1);
            $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : null;
        } else {
            $tmp = isset($row[$columnKey]) ? $row[$columnKey] : null;
        }
        if (!$indexKeyIsNull) {
            if ($indexKeyIsNumber) {
                $key = array_slice($row, $indexKey, 1);
                $key = (is_array($key) && !empty($key)) ? current($key) : null;
                $key = is_null($key) ? 0 : $key;
            } else {
                $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
            }
        }
        $result[$key] = $tmp;
    }
    return $result;
}
//分享
function make_nonceStr() {
    $codeSet = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < 16; $i++) {
        $codes[$i] = $codeSet[mt_rand(0, strlen($codeSet) - 1)];
    }
    $nonceStr = implode($codes);
    return $nonceStr;
}


/**
 * 获楼盘取封面图
 * @param $path  从数据库中读取的封面图数据（没带前面地址）
 * @param $default_img  默认图片，  default.jpg 小图，  house.png 大图 
 * @auth whj
 */
function get_full_cover_path($path,$default_img='default.jpg') {
	//为空或者图片数据以'/title\/title.jpg'结尾的取默认图
	$path = $path && !preg_match("/^[\w\W]*\/title\/title.jpg$/", $path) ?$path:$default_img;
	$path = C('IMAGE_BASE_URL').$path;
	return $path;
}
/**
 * 获取地理位置哈希值
 * @param  string $latitude  纬度
 * @param  string $longitude 经度
 * @return string            哈希值
 */
function getGeohash($latitude, $longitude) {
    $Geohash = new \Vendor\Geohash\Geohash;
    return $Geohash->encode($latitude, $longitude);
}
/**
 * 组织拼接楼盘地址
 * @param  string  $address 楼盘地址
 * @param  string  $adcode  区码
 * @param  boolean $replace 是否替换字符
 * @return string
 */
function concatAddress($address, $adcode, $replace = false) {
    if (!$address || !$adcode) {
        return $address;
    }
    $Area = M('Area');
    $map = array('adcode' => $adcode);
    $country = $Area->where($map)->getField('name');
    if ($replace) {
        $address = str_replace($country, '', $address);
    } else {
        $address = $country . $address;
    }
    $zhixiashi = array('11', '12', '31', '50', '81', '82'); //直辖市开头
    if (in_array(substr($adcode, 0, 2), $zhixiashi)) {
        $map['adcode'] = substr($adcode, 0, 2) . '0000';
    } else {
        $map['adcode'] = substr($adcode, 0, 4) . '00';
    }
    $city = $country = $Area->where($map)->getField('name');
    if ($replace) {
        $address = str_replace($city, '', $address);
    } else {
        $address = $city . $address;
    }
    return $address;
}

/**
* 检测图片/文件/URL是否存在
* @author Rex Wong
* @param STR $str
*/
function url_exists($str) {
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $str);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($http_code == 200) {
        return true;
    }
    return false;
}