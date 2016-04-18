<?php
/**
*
* 版权所有：恰维网络<qwadmin.qiawei.com>
* 作    者：寒川<hanchuan@qiawei.com>
* 日    期：2015-09-17
* 版    本：1.0.0
* 功能说明：后台公共文件。
*
**/

/**
*
* 函数：日志记录
* @param  string $log   日志内容。
* @param  string $name （可选）用户名。
*
**/
function addlog($log,$name=false){
	$Model = M('log');
	if(!$name){
		$user = cookie('user');
		$data['name'] = $user['user'];
	}else{
		$data['name'] = $name;
	}
	$data['t'] = time();
	$data['ip'] = $_SERVER["REMOTE_ADDR"];
	$data['log'] = $log;
	$Model->data($data)->add();
}


/**
*
* 函数：获取用户信息
* @param  int $uid      用户ID。
* @param  string $name  数据列（如：'uid'、'uid,user'）
*
**/
function member($uid,$field=false) {
	$model = M('Member');
	if($field){
		return $model ->field($field)-> where(array('uid'=>$uid)) -> find();
	}else{
		return $model -> where(array('uid'=>$uid)) -> find();
	}
}
function check_content($cnt){
	if($cnt=='') return false;
	if(strpos($cnt," ")===0) return false;
	// 全部重复
    $repeat = true;
	$len = strlen($cnt);
	$first = substr($cnt,0,1); 
	for($i = 1;$i < $len;$i++){
		$repeat = $repeat && substr($cnt,$i,1)==$first;
	}
	return !$repeat;
}
function change_content($cnt){
	$cnt=str_replace(" ","&nbsp",$cnt); 
	$cnt=str_replace("\n","<br />",$cnt); 
	$cnt=str_replace("http://","",$cnt); 
	$cnt=preg_replace("/\[b\](.*?)\[\/b\]/i","<b>\${1}</b>",$cnt);
	$cnt=preg_replace("/\[url\](.*?)\[\/url\]/i","<a href='http://\${1}' target='_blank'>\${1}</a>",$cnt);
	return $cnt;
}
/**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符
     * @return string
     */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
    if(function_exists("mb_substr")){
            if ($suffix && strlen($str)>$length)
                return mb_substr($str, $start, $length, $charset)."...";
        else
                 return mb_substr($str, $start, $length, $charset);
    }
    elseif(function_exists('iconv_substr')) {
            if ($suffix && strlen($str)>$length)
                return iconv_substr($str,$start,$length,$charset)."...";
        else
                return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}