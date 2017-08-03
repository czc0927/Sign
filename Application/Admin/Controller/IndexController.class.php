<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    
    public function index(){
        // $adminCount = D("Admin")->getLastLoginUsers();
        // $this->assign('admincount', $adminCount);
        $this->display();
    }
    public function welcome(){
    	$this->display();
    }

}