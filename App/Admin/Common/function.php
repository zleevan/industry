<?php
/**
*
* ��Ȩ���У�ǡά����<qwadmin.qiawei.com>
* ��    �ߣ�����<hanchuan@qiawei.com>
* ��    �ڣ�2015-09-17
* ��    ����1.0.0
* ����˵������̨�����ļ���
*
**/

/**
*
* ��������־��¼
* @param  string $log   ��־���ݡ�
* @param  string $name ����ѡ���û�����
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
* ��������ȡ�û���Ϣ
* @param  int $uid      �û�ID��
* @param  string $name  �����У��磺'uid'��'uid,user'��
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
	// ȫ���ظ�
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
     * �ַ�����ȡ��֧�����ĺ���������
     * @static
     * @access public
     * @param string $str ��Ҫת�����ַ���
     * @param string $start ��ʼλ��
     * @param string $length ��ȡ����
     * @param string $charset �����ʽ
     * @param string $suffix �ض���ʾ�ַ�
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
    if($suffix) return $slice."��";
    return $slice;
}