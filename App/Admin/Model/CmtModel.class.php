<?php
namespace Admin\Model;
use Think\Model;

class CmtModel extends Model {
	public function get_cmt($data,$keyword,$order){
		$Cmt = M('Cmt');
		$Need = M('Need');
		if($keyword != null){
			if($data['field']=="send"){
				$need['user'] = $keyword;
			}
			if($data['field']=="get"){
				$need['getter'] = $keyword;
			}
			if($data['field']=="kwtitle"){
				$map['title'] = array('like',"%$keyword%");	
				$needList = $Need->field('id')->where($map)->select();
				$nid = array();
				foreach($needList as $countid){
					$nid[]=$countid['id'];
				}
				$need['needid'] = array('in',$nid);
			}
			if($data['field']=="kwcmt"){
				$need['content'] = array('like',"%$keyword%");
			}
			$list = $this->where($need)->order("$order")->select();
		}else{
			$list = $this->order("$order")->select();
		}
		foreach($list as &$cList){
			$title = $Need->field('title')->where("id = $cList[needid]")->find();
			$cList['title'] = $title['title'];
		}
		return $list;
	}
}