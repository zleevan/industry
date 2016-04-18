<?php
namespace Home\Controller;
use Think\Controller;
class AccountController extends Controller {
    public function index(){
		$data = session('account');
		$id = session('id');
		if(!isset($id)){
			$this->redirect('Index/index');
		}
		$user = M('Person')->where("id = $id")->find();
		$user['cmt'] = M('Cmt')->where("user = '$user[name]'")->count();
		$Need = D('Need');
		$count = $Need->where("userid = $id")->count(); // 查询满足要求的总记录数
		$user['need'] = $count;
		$Page = new \Think\Page($count,5); // 实例化分页类 传入总记录数和每页显示的记录数(10)
		$needList = $Need->where("userid = $id")->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$needList = $Need->get_UC($needList);
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('header','');
		$this->assign($user);
		$show = $Page->show(); // 分页显示输出
		$this->assign('page', $show); // 赋值分页输出
		$this->assign('needList',$needList);
		$this->assign("account",$data);
		$this->display();
    }
	public function update(){
		$id = session('id');
		$Person = M('Person');
		$Person->create();
		$result = $Person->where("id = $id")->save();
		if($result){
			$flag = true;
		}else{
			$flag = false;
		}
		$this->ajaxReturn($result);
	}
	public function getInfo(){
		$id = session('id');
		$data = M('Person')->field('name,email,brief')->where("id = $id")->find();
		$this->ajaxReturn($data);
	}
}