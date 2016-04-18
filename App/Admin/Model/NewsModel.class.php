<?php
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model {
	public function get_news($data,$keyword,$order){
		if($keyword != null){
			if($data['field']=="kwtitle"){
				$news['title'] = array('like',"%$keyword%");	
			}
			if($data['field']=="kwcnt"){
				$news['content'] = array('like',"%$keyword%");
			}
			$list = $this->where($news)->order("$order")->select();
		}else{
			$list = $this->order("$order")->select();
		}
		return $list;
	}
}