<?php
namespace Home\Model;
use Think\Model;
// R(read) U(user) C(comment) L(like) C(collect)
class NeedModel extends Model {
	public function get_UC($list){
		$Person = M('Person');
		$Cmt = M('Cmt');
		foreach($list as &$cList){
			$user = $Person->field('name')->where("id = $cList[userid]")->find();
			$view = $Cmt->where("needid = $cList[id]")->count();
			$cList['user'] = $user['name'];
			$cList['cmt'] = $view;
		}
		return $list;
	}
	public function get_list($id){
		$need = "need".$id;
		$Person = M('Person');
		$Category = M('Category');
		$needList = $this->where("id=$id")->find();
		if(session("$need")!=$id){
			session("$need",$id);
			$needList['read'] = $needList['read'] + 1;
			$data['read'] = $needList['read'];
			$this->where("id=$id")->save($data);
		}
		$username = $Person->field('name')->where("id=$needList[userid]")->find();
		$navname =  $Category->field('name')->where("id=$needList[cateid]")->find();
		$needList['user'] = $username['name'];
		$needList['cate'] = $navname['name'];
		unset($username,$navname,$needList['userid'],$needList['cateid']);
		return $needList;
	}
}
?>