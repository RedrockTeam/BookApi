<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
	public function index(){
		echo "hello";
		$this->ajaxReturn("success");
	}

}