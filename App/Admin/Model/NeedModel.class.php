<?php
namespace Admin\Model;
use Think\Model;
class NeedModel extends Model {
	public function get_list($id){
		$list = $this->where("id = $id")->find();
		$Person = M('Person');
		$Category = M('Category');
		$user = $Person->field('name')->where("id = $list[userid]")->find();
		$cate = $Category->field('name')->where("id = $list[cateid]")->find();
		$list['user'] = $user['name'];
		$list['cate'] = $cate['name'];
		return $list;
	}
	
	public function get_UC($data,$keyword,$order){
		$Person = M('Person');
		$Category = M('Category');
		$Cmt = M('Cmt');
		if($keyword != null){
			if($data['field']=="user"){
				$user = $Person->field('id')->where("name = '$keyword'")->find();
				$need['userid'] = $user['id'];
			}
			if($data['field']=="cate"){
				$cate = $Category->field('id')->where("name = '$keyword'")->find();
				$need['cateid'] = $cate['id'];
			}
			if($data['field']=="kwtitle"){
				$need['title'] = array('like',"%$keyword%");	
			}
			if($data['field']=="kwcnt"){
				$need['content'] = array('like',"%$keyword%");
			}
			$list = $this->where($need)->order("$order")->select();
		}else{
			$list = $this->order("$order")->select();
		}
		foreach($list as &$cList){
			$user = $Person->field('name')->where("id = $cList[userid]")->find();
			$cate = $Category->field('name')->where("id = $cList[cateid]")->find();
			$cList['cmt'] = $Cmt->where("needid = $cList[id]")->count();
			$cList['user'] = $user['name'];
			$cList['cate'] = $cate['name'];
		}
		return $list;
	}
}

