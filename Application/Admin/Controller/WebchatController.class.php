<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
class WebchatController extends ChatController {
    private $pageRes;
    public function index() {
        $this->display();
    }
    public function register(){
        if($_POST){
        	if($_POST['phone']){
        		 $phone=$_POST['phone'];	 
        	}
        	if($_POST['code']){
        		 $code=$_POST['code'];
        	}
            $sessioncode=session('code');
            if($sessioncode==$code){
               return show(1,'开锁成功');
            }else{
            	return show(0,'验证码错误');
            }
        }
    	$this->display();
    }
    public function depart(){
            $count=D('Depart')->getCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $departs =D('Depart')->select($data,$page,$pageSize);
            $this->assign('departs', $departs);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
    	    $this->display();
    }
     public function staff(){
        $data['depart_id'] = $_GET['depart_id'] ? intval($_GET['depart_id']) :0;
        $depart=D('Depart')->getAdminByDepartId($data['depart_id']);
        if($depart){
            $dep=$depart['name'];
            $this->assign('dep', $dep);
        }
            $departs = D("Depart")->getNormalDeparts();
            $count=D('Staff')->getCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $staffs =D('Staff')->select($data,$page,$pageSize);
            $list=D('Scribe')->getdescribes();
            $staffs=D('Staff')->getScribes($staffs,$list);
            $this->datajson($departs);
            $this->assign('staffs', $staffs);
            $this->assign('pageRes', $this->pageRes);
            $this->display();


        // var_dump($staffs); 
    }
    public function personCenter(){
        $user=session('Chatuser');
        $depart=D('Depart')->getAdminByDepartId($user['depart_id']);
        $this->assign('user',$user);
        $this->assign('departname',$depart['name']);
    	$this->display();
    }
    public function today(){
        $staffs = D("Attend")->selectday($data);
        $this->assign('staffs', $staffs);
    	$this->display();
    }
    public function subscribe(){
        if($_POST){
            $data['describe_id']=intval($_POST['id']);
            $status=intval($_POST['status']);
        
        $user=session('Chatuser');
        $data['scribe_id']=$user['staff_id'];
        $data['phone']=$user['telephone'];
        if(!$status){
             $rest=D('Scribe')->insert($data);
             if($rest){
                return show(1,'预约成功');
             }else{
                 return show(0,'预约失败');
             }
        }
        else{
            $rest=D('Scribe')->deletebyid($data['describe_id']);
            if($rest){
                return show(1,'取消预约成功');
             }else{
                 return show(0,'取消预约失败');
             }
        }
    }
    }
    public function cooke(){
        session('code',null);
        $code = rand(100000,999999);
        $phone=$_POST['phone'];
        $this->sendMsg($phone,$code);
    }
    public function datajson($departs,$tmpfile="class-data.js"){
        $str="";
         $text1=sprintf("{value:'%s',text:'%s'},",'0','全部');
        foreach ($departs as $depart) {
            $text=sprintf("{value:'%s',text:'%s'},",$depart['depart_id'],$depart['name']);
            $str=$str.$text;
        }
        $str="var classData =[".$text1.$str."]";
        $path ="./Public/webchat/js/".$tmpfile;
        file_put_contents($path,$str);
    }
    public function live(){
    	$this->display();
    }
    public function sendMsg($phone,$code){
         import('AliMsg.AliMsgSend');
       if($_POST) {
                    $result=D("Staff")->isphone($phone);
                    if($result){
                          $hadle=new \AliMsgSend($phone,$code);
                           $resp=$hadle->sendMsg();
                           if($resp){
                               session('code', $code);
                                return show(1,'发送验证码成功');
                           }else{
                             session('code',null);
                             return show(0,'发送验证码失败');
                           }
                 }else{
                    session('code',null);
                    return show(0,'该手机号码不存在');
                 }  
        }
    }
}