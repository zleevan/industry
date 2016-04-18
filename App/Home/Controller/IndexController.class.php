<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8");
class IndexController extends Controller {
    public function index(){	
		$Article = M('Article');
		
		$sort = $Article  -> field('o,title,thumbnail,aid') -> where('o <= 6') -> order('o asc');
		$topsix =$sort -> select();
		$length	=$sort-> count();

		
		$Flash = M('Flash');
		$tag['where'] = '首页';
		$tag['o'] = 1;
		$flash1 = $Flash -> where($tag) ->find();
		$this -> assign("length",$length);
		$this -> assign("topsix",$topsix);
		$this -> assign("flash",$flash1);		
		$data = session('account');
		$this -> assign("account",$data);
        $this->display();
    }
}