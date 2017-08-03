<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class WebloginController extends Controller {

    public function index(){
        if(session('Chatuser')) {
           $this->redirect('./admin.php?c=Webchat');
        }
        // admin.php?c=index
        $this->display();
    }

    public function check() {

        $telephone = $_POST['telephone'];
        $code = $_POST['code'];
        if(!trim($telephone)) {
            return show(0,'手机号不能为空');
        }
        if(!trim($code)) {
            return show(0,'验证码不能为空');
        }
        $usercode=session('usercode');
         $ret = D('Staff')->getUserbyphone($telephone);
            if($usercode==$code){
                session('Chatuser', $ret);
               return show(1,'登录成功');
            }else{
                return show(0,'验证码错误');
            }
    }
     public function cooke(){
        import('AliMsg.AliMsgSend');
       if($_POST) {
                    $code = rand(100000,999999);
                    $phone=$_POST['phone'];
                    $result=D("Staff")->isphone($phone);
                    if($result){
                          $hadle=new \AliMsgSend($phone,$code);
                           $resp=$hadle->sendMsg();
                           if($resp){
                               session('usercode', $code);
                                return show(1,'发送验证码成功');
                           }else{
                             session('usercode',null);
                             return show(0,'发送验证码失败');
                           }
                 }else{
                    session('usercode',null);
                    return show(0,'该手机号码未授权');
                 }    
        } 
    }

    public function loginout() {
        session('user', null);
        $this->redirect('./admin.php?c=weblogin');
    }

}