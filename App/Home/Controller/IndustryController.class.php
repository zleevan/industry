<?php
namespace Home\Controller;
use Think\Controller;
class IndustryController extends Controller {
    public function index(){
		$News = M('News');
		$newsList = $News->order('id desc')->select();
		$this->assign('newsList',$newsList);
        $this->display();
    }
	 public function info(){
		$data['id'] = I('get.id');
		$News = M('News');
		$newsList = $News->where($data)->find();
		$this->assign($newsList);
        $this->display();
    }
}