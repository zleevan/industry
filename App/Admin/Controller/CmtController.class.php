<?php
/**
*
* 版权所有：恰维网络<qwadmin.qiawei.com>
* 作    者：寒川<hanchuan@qiawei.com>
* 日    期：2016-09-20
* 版    本：1.0.0
* 功能说明：文章控制器。
*
**/

namespace Admin\Controller;
use Admin\Controller;

class CmtController extends ComController {
	public function index(){
		$Cmt = D('Cmt');
		$data['field']=I('get.field');
		$keyword = I('get.keyword');
		$order = 'time '.I('get.order');
		$list = $Cmt->get_cmt($data,$keyword,$order);
		$this->assign('list',$list);
		$this->display();
	}
	public function del(){
		$uids= I('param.uids');
		$map['id']  = array('in',$uids);
		if( M('Cmt')->where($map)->delete()){
			addlog('删除评论UID：'.$uids);
			$this->success('恭喜，评论删除成功！');
		}else{
			$this->error('参数错误！');
		}
	}
	public function edit(){
		$data['id'] = I('post.id');
		$data['content'] = I('post.content');
		M('Cmt')->save($data);
		addlog('修改评论UID：'.$data['id']);
		
	}
}