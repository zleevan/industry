<?php
/**
*
* 版权所有：恰维网络<qwadmin.qiawei.com>
* 作    者：寒川<hanchuan@qiawei.com>
* 日    期：2016-01-20
* 版    本：1.0.0
* 功能说明：用户控制器。
*
**/

namespace Admin\Controller;
use Admin\Controller\ComController;
class PersonController extends ComController {
    public function index(){
		

		$p = isset($_GET['p'])?intval($_GET['p']):'1';
		$field = isset($_GET['field'])?$_GET['field']:'';
		$keyword = isset($_GET['keyword'])?htmlentities($_GET['keyword']):'';
		$order = isset($_GET['order'])?$_GET['order']:'DESC';
		$where = '';
		
		$prefix = C('DB_PREFIX');
		if($order == 'asc'){
			$order = "{$prefix}person.t asc";
		}elseif(($order == 'desc')){
			$order = "{$prefix}person.t desc";
		}else{
			$order = "{$prefix}person.id asc";
		}
		if($keyword <>''){
			if($field=='user'){
				$where = "{$prefix}person.account LIKE '%$keyword%'";
			}
			if($field=='name'){
				$where = "{$prefix}person.name LIKE '%$keyword%'";
			}
			if($field=='phone'){
				$where = "{$prefix}person.mobile LIKE '%$keyword%'";
			}
			if($field=='email'){
				$where = "{$prefix}person.email LIKE '%$keyword%'";
			}
			
		}
		
		
		$user = M('person');
		$pagesize = 10;#每页数量
		$offset = $pagesize*($p-1);//计算记录偏移量
		$count = $user->count();
		
		$list  = $user->field("{$prefix}person.*")->order($order)->where($where)->limit($offset.','.$pagesize)->select();
		//$user->getLastSql();
		$page	=	new \Think\Page($count,$pagesize); 
		$page = $page->show();
        $this->assign('list',$list);	
        $this->assign('page',$page);
		
		$this -> display();
		
    }
	
	public function del(){
		
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:false;
		//uid为1的禁止删除
		if(is_array($id)) 
		{
			foreach($id as $k=>$v){
				$id[$k] = intval($v);
			}
			if(!$id){
				$this->error('参数错误！');
				$id = implode(',',$id);
			}
		}

		$map['id']  = array('in',$id);
		if(M('person')->where($map)->delete()){
			$this->success('恭喜，用户删除成功！');
		}else{
			$this->error('参数错误！');
		}
	}
	
	public function edit(){
		
		$id = isset($_GET['id'])?intval($_GET['id']):false;
		if($id){	
			//$person = M('person')->where("uid='$uid'")->find();
			$prefix = C('DB_PREFIX');
			$user = M('person');
			$person  = $user->field("{$prefix}person.*")->where("{$prefix}person.id=$id")->find();

		}else{
			$this->error('参数错误！');
		}
		
		$this -> assign('person',$person);
		$this -> display();
	}
	
	public function update($ajax=''){
		if($ajax=='yes'){
			$id = I('get.id',0,'intval');
			die('1');
		}
		
		$id = isset($_POST['id'])?intval($_POST['id']):false;	
		
		$account = isset($_POST['account'])?htmlspecialchars($_POST['account'], ENT_QUOTES):'';
		
		$name = isset($_POST['name'])?trim($_POST['name']):false;
		
		$password = isset($_POST['password'])?trim($_POST['password']):false;
		
		$cpassword = isset($_POST['cpassword'])?trim($_POST['cpassword']):false;
		
		if($password) {
			$salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
			$pwd=sha1($password.$salt);
			$data['password'] = $pwd;
			$data['salt'] = $salt;
		}
		

		
		$head = I('post.head','','strip_tags');
		if($head<>'') {
			$data['head'] = $head;
		}
		$data['mobile'] = isset($_POST['mobile'])?trim($_POST['mobile']):'';
		$data['email'] = isset($_POST['email'])?trim($_POST['email']):'';
		$data['t'] = time();
		if(!$id){
			if(!preg_match("/^[a-zA-Z][a-zA-Z0-9_]{4,20}$/",$account)){
				$this->error('登录账号有误');
			}
			
			if($name==''){
				$this->error('用户名有误');
			}
			
			if(!preg_match("/\S{5,16}/",$password)){
				$this->error('用户密码不能为空，且5-16个字节！');
	
			}		
			if(!($cpassword===$password)){
				$this->error('确认密码错误，请检测！');
			}
			
			if(M('person')->where("account='$account'")->count()){
				$this->error('用户名已被占用！');
			}
			$data['name'] = $name;
			$data['account'] = $account;
			$id = M('person')->data($data)->add();
			addlog('新增会员，会员UID：'.$id);
		}else{
			M('person')->data($data)->where("id=$id")->save();
			addlog('编辑会员信息，会员UID：'.$id);
		}
		$this->success('操作成功！','index');
	}
	
	
	public function add(){

		$usergroup = M('auth_group')->field('id,title')->select();
		$this->assign('usergroup',$usergroup);
		$this -> display();
	}
}