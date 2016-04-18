<?php
namespace Home\Controller;
use Think\Controller;
class DesignController extends Controller {
	public function index(){
		$Flash = M('flash');
		$tag['where'] = '设计作品';
		$tag['o'] = 1;
		$flash1 = $Flash -> where($tag) ->find();
		$this -> assign("flash",$flash1);
		$Article = M('Article');		
		$data = $Article -> field('title,thumbnail,keywords,aid')-> select();
		$this -> assign("data",$data);
		$this->display();
	}
	public function info($aid){
		$Article = M('Article');
		$data = $Article -> where("aid = '$aid'") ->find();
		
		
		$Category = M('category');
		
				
		$sid = $data['sid'];
		$data['category'] = $Category -> where("id = '$sid'") -> getField('name');
		$this -> assign("data",$data);
		
		$this->display();
	}
}