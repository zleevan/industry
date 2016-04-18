<?php
namespace Home\Controller;
use Think\Controller;
class NeedController extends Controller {
    public function index(){
		$Category = M('Category');
		$cateList = $Category->order("pid desc,id asc")->select();
		$Need = D('Need');
		$count = $Need->count(); // 查询满足要求的总记录数
		$Page = new \Think\Page($count,10); // 实例化分页类 传入总记录数和每页显示的记录数(10)
		$needList = $Need->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('selectid',"0");
		if(IS_GET){
			$data['cateid'] = I('get.list');
			if($data['cateid']!=0){
				$count = $Need->where($data)->count(); // 查询满足要求的总记录数
				$Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数(10)
				$needList = $Need->where($data)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
				$this->assign('selectid',$data['cateid']);
			}
		}
		$needList = $Need->get_UC($needList);
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('header','');
		$show = $Page->show(); // 分页显示输出
		$this->assign('page', $show); // 赋值分页输出
		$this->assign('needList',$needList);
		$this->assign('cateList',$cateList);
        $this->display();
	}
	public function theme(){
		$Need = D('Need');
		$needList = $Need->get_list(I('get.id'));
		$Cmt = D('Cmt');
		$commentList = $Cmt->get_cmt(I('get.id'));
		$this->assign('commentList',$commentList);
		$this->assign($needList);
		$this->display();
	}
	public function publish(){
		$data['user'] = session('user'); 
		$Category = M('Category');
		$Person = M('Person');
		$user = $Person->field('name')->where($data)->find();
		$cateList = $Category->field('name,id')->order("pid desc,id asc")->select();
		$this->assign('name',$user['name']);
		$this->assign('cateList',$cateList);
		$this->display();
	}
	public function checkPublish(){
		$data['userid'] = session('id');
		if(!isset($data['userid'])){
			$flag = 0;
			$this->ajaxReturn($flag);
		}
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
	public function sendCmt(){
		$data['user'] = session('name');
		$data['pid'] = I('post.pid');
		$data['getter'] = I('post.getter');
		$data['needid'] = I('post.needid');
		$data['content'] = I('post.cnt');
		$data['time'] = date("Y-m-d H:i:s ");
		if($data['user']==''){
			$flag = 0;
			$this->ajaxReturn($flag);
		}
		if(!check_content($data['content'])){
			$flag = 1;
			$this->ajaxReturn($flag);
		}
		$Cmt = M('cmt');
		$Cmt->add($data);
		$flag = 2;
		$this->ajaxReturn($flag);
	}
}