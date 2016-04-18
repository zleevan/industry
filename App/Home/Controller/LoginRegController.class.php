<?php
namespace Home\Controller;
use Think\Controller;
class LoginRegController extends Controller {
    public function index(){
        $this->display();
	}
		
	public function register(){
		$account = I('post.account');
		$password = I('post.password');
		$cpassword = I('post.cpassword'); 
		$name = I('post.name'); 
		$mobile = I('post.mobile');
		$email = I('post.email');
		$verify = I('post.verify');
		
		$data['name'] = $name;
		$data['account'] = $account;		
		$data['mobile'] = $mobile;
		$data['email'] = $email;
		if(check_account($account)===1){
			$this->ajaxReturn(1);
		}
		else if (check_account($account)===2){
			$this->ajaxReturn(2);
		}
		if(check_pwd($password)===false){
			$this->ajaxReturn(3);
		}
		if(!($password===$cpassword)){
			$this->ajaxReturn(4);
		}
		if(check_name($name)===false){
			$this->ajaxReturn(5);
		}
		if(check_mobile($mobile)===false){
			$this->ajaxReturn(6);
		}
		if(check_email($email)===false){
			$this->ajaxReturn(7);
		}
		if(check_verify($verify)===false){
			$this->ajaxReturn(8);
		}
		
		$Model = M('Person');
		$salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
		$password=sha1($password.$salt);
		$data['password'] = $password;
		$data['salt'] = $salt;
		$Model ->create($data);

		$id = $Model ->add();
		session('account',$account); 
		session('name',$data['name']); 
		session('id',$id); 
		$this->ajaxReturn(9);

	
		
	}	
	
	
	public function login(){
		
		$account = I('post.account');
		$password = I('post.password');
		$remenber = I('post.remenber');
		
		if(!preg_match("/^[a-zA-Z][a-zA-Z0-9_]{4,20}$/",$account)){
			$this->ajaxReturn(1);
		}	
		
		/*检测用户名和密码*/
		$Model = M('Person');
		$map['account'] = $account;
		$data = $Model ->field('id,account,salt,password,name')-> where($map) -> find();
		$pwd=sha1($password.$data['salt']);
		if($pwd==$data['password']){
			session('name',$data['name']); 
			session('account',$map['account']);
			session('id',$data['id']); 
			if($remember){
			cookie('account',$account,3600*24*365);//记住我
			}else{
			cookie('account',$account);
			}
			$this->ajaxReturn(2);
		}
		else $this->ajaxReturn(1);
		
		
    }
	
	public function quit() {
		
		session(null);
	}
	
	public function verify() {
		$config = array(
		'fontSize' => 14, // 验证码字体大小
		'length' => 4, // 验证码位数
		'useNoise' => false, // 关闭验证码杂点
		'imageW'=>100,
		'imageH'=>34,
		);
		$verify = new \Think\Verify($config);
		$verify -> entry();
	}
		
	
	
}