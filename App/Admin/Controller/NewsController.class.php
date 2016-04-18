<?php
namespace Admin\Controller;
use Admin\Controller;

class NewsController extends ComController {
	public function index(){
		$News = D('News');
		$data['field']=I('get.field');
		$keyword = I('get.keyword');
		$order = 'time '.I('get.order');
		$list = $News->get_news($data,$keyword,$order);
		$this->assign('list',$list);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function del(){
		$uids= I('param.uids');
		$map['id']  = array('in',$uids);
		if( M('News')->where($map)->delete()){
			addlog('删除新闻UID：'.$uids);
			$this->success('恭喜，新闻删除成功！');
		}else{
			$this->error('参数错误！');
		}
	}
	public function edit(){
		$id =I('get.id');
		$list = M('News')->where('id='.$id)->find();
		$this->assign($list);
		$this->display();
	}
	public function update(){
		$id =I('post.id');
		$data['title'] = I('post.title');
		$data['content'] = I('post.content');
		$data['time'] =  date("Y-m-d H:i:s");
		if($id){
			M('News')->where('id='.$id)->save($data);
			addlog('编辑作品，ID：'.$id);
			$this->success('恭喜！作品编辑成功！');
		}else{
			$id = M('News')->add($data);
			if($id){
				addlog('新增作品，ID：'.$id);
				$this->success('恭喜！作品新增成功！');
			}else{
				$this->error('抱歉，未知错误！');
			}
		}
		
	}
}