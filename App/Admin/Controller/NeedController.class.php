<?php
namespace Admin\Controller;
use Admin\Controller;

class NeedController extends ComController {
	public function need(){
		$Need = D('Need');
		$data['field']=I('get.field');
		$data['cate']=I('get.cate');
		$keyword = I('get.keyword');
		$order = 'time '.I('get.order');
		$list = $Need->get_UC($data,$keyword,$order);
		$this->assign('list',$list);
		$this->display();
	}
	public function cmt(){
		$Cmt = D('Cmt');
		$commentList = $Cmt->get_cmt(I('get.id'));
		$this->assign('commentList',$commentList);
		$this->display();
	}
	public function del(){
		$uids= I('param.uids');
		$map['id']  = array('in',$uids);
		if( M('Need')->where($map)->delete()){
			addlog('删除需求UID：'.$uids);
			$this->success('恭喜，需求删除成功！');
		}else{
			$this->error('参数错误！');
		}
	}
	public function add(){
		$Category = M('Category');
		$cateList = $Category->order("pid desc,id asc")->select();
		$this->assign('cateList',$cateList);
		$this->display();
	}
	public function edit(){
		$id = I('get.id');
		$Need = D('Need');
		$list = $Need->get_list($id);
		$Category = M('Category');
		$cateList = $Category->order("pid desc,id asc")->select();
		$this->assign('cateList',$cateList);
		$this->assign('list',$list);
		$this->display();
	}
	public function checkAdd(){
		$user = cookie('user');
		$data['userid'] = $user['uid'];
		$data['title'] = I('post.title');
		if(!check_content($data['title'])){
			$flag = 1;
			$this->ajaxReturn($flag);
		}
		$data['cateid'] = I ('post.selectList');
		if($data['cateid']==0){
			$flag = 2;
			$this->ajaxReturn($flag);
		}
		$data['content'] = I('post.publishCnt');
		if(!check_content($data['content'])){
			$flag = 3;
			$this->ajaxReturn($flag);
		}
		$data['time'] = date("Y-m-d H:i:s ");
		$data['content'] = change_content($data['content']);
		$Need = M('Need');
		$Need->add($data);
		$flag = 4;
		$this->ajaxReturn($flag);
	}
	public function checkUpdate(){
		$id = I('post.id');
		$data['title'] = I('post.title');
		if(!check_content($data['title'])){
			$flag = 1;
			$this->ajaxReturn($flag);
		}
		$data['cateid'] = I ('post.selectList');
		if($data['cateid']==0){
			$flag = 2;
			$this->ajaxReturn($flag);
		}
		$data['content'] = I('post.publishCnt');
		if(!check_content($data['content'])){
			$flag = 3;
			$this->ajaxReturn($flag);
		}
		$data['time'] = date("Y-m-d H:i:s");
		$data['content'] = change_content($data['content']);
		$Need = M('Need');
		$Need->where("id = $id")->save($data);
		$flag = 4;
		$this->ajaxReturn($flag);
	}
}