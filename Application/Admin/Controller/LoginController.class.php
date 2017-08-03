<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){
        if(session('adminUser')) {
           $this->redirect('./admin.php?c=index');
        }
        // admin.php?c=index
        $this->display();
    }

    public function check() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $code=$_POST['code'];
        $online=$__POST['online'];
        if(!trim($username)) {
            return show(0,'用户名不能为空');
        }
        if(!trim($password)) {
            return show(0,'密码不能为空');
        }
        if(!trim($code)){
             return show(0,'验证码不能为空');
        }
        $ret = D('Admin')->getAdminByUsername($username);
        if(!$ret || $ret['online'] !=1) {
            return show(0,'该用户不存在');
        }

        if($ret['password'] != getMd5Password($password)) {
            return show(0,'密码错误');
        }
        if($this->check_verify($code)){
                 D("Admin")->updateByAdminId($ret['admin_id'],array('lastlogintime'=>time()));
                 if(trim($online)){
                    session(array('adminUser'=>$ret,'expire'=>604800));
                 }else{
                    session('adminUser', $ret);
                 }
                 return show(1,'登录成功');
            }
            else{
                return show(0,'验证码错误');
            }
    }

    public function loginout() {
        session('adminUser', null);
        $this->redirect('./admin.php?c=login');
    }
    Public function verify(){
        $config =    array(
            'fontSize'    =>    25,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
            'imageH'      =>40,
            'imageW'      =>140,
        );
                ob_clean();
                $verify = new \Think\Verify($config);
                $verify->entry();
    }
    function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

}