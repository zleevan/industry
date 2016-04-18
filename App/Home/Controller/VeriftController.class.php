<?php
namespace Home\Controller;
use Think\Controller;
class VerifyController extends Controller {
	
	function a(){echo "aa";}
	$usertype = I('post.usertype');
	$user = I('post.user');
	$password = I('post.password');
	$cpassword = I('post.cpassword');
	$mobile = I('post.mobile');
	$email = I('post.email');
	$verify = I('post.verify');

}