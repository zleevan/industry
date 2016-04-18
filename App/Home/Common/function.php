<?php 



//**注册**//
/*验证用户名*/
function check_account($account){
	if(!preg_match("/^[a-zA-Z][a-zA-Z0-9_]{4,20}$/",$account))
		  return 1;
	$Model = M('Person');
	$map['account'] = $account;
	$confirm = $Model ->field("account")-> where($map) -> find();
	if($confirm){
		return 2;}
	return false;
				
}

/*验证密码*/
function check_pwd($password){
	if(!preg_match("/\S{5,16}/",$password))
		return false;
}

/*验证昵称*/
function check_name($name){
	if($name=='') return false;
	if(strpos($name," ")===0||strpos($name," ")) return false;
}


/*验证手机号码*/
function check_mobile($mobile){
	if(!preg_match("/1[3458]{1}\d{9}$/",$mobile))
		return false;
}

/*验证邮箱*/
function check_email($email){
	if(!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$email))
		return false;
}

/*验证验证码*/
function check_verify($code, $id = ''){
	$verify = new \Think\Verify();
	return $verify -> check($code, $id);
}


//comment function
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
	$cnt=preg_replace("/\[code\](.*?)\[\/code\]/i","<pre>\${1}</pre>",$cnt);
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


?>