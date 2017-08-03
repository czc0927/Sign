<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
class BasicController extends CommonController {
    public function index() {
       $this->display();
    }
    public function log(){
        $this->display();
    }
}