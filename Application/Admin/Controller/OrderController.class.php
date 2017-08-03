<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
class OrderController extends Controller {
    public function index() {
        if(IS_POST){
            $str=$GLOBALS['HTTP_RAW_POST_DATA'];
            $order=$this->sub($str);
            switch ($order['order']) {
                case 'UNLOCK':
                    $this->unlock($order['sno']);
                    break;
                case 'ADDUSR':
                   $this->addusr($order['sno']);
                    break;
                case 'DELUSR':
                   $this->delusr($order['sno']);
                    break;
                default:
                    break;
            }
        }
    }
    public function unlock($sno){
        $staff=D('Staff')->getUserbysno($sno);
        $data['staff_id']=$staff['staff_id'];
        $isonlie=D('Staff')->isOnlineStaffId($data['staff_id']);
        if(!$isonlie){
        	$str="ERROR+";
        	@header("Content-type:text/plain;charset=UTF-8");
        	echo $str;
         }else{
            $data['wordtime']=time();
            $data['depart_id']=$isonlie['depart_id'];
            $data['name']=$isonlie['name'];
            $data['model']=$isonlie['model'];
            $id=D('Attend')->insert($data);
            if ($id) {
               $str="OK+";
        	@header("Content-type:text/plain;charset=UTF-8");
        	echo $str;
             }else {
             	 $str="ERROR+";
        	@header("Content-type:text/plain;charset=UTF-8");
        	echo $str;
             }
         }
    }
    public function addusr($sno){
        $res = D('Staff')->updateStatusBySno($sno,1);
        if ($res) {
            $str="OK+";
        	@header("Content-type:text/plain;charset=UTF-8");
        	echo $str;
         } else {
          $str="ERROR+";
        	@header("Content-type:text/plain;charset=UTF-8");
        	echo $str;
       
         }
    }
     public function delusr($sno){
        $res = D('Staff')->updateStatusBySno($sno,-1);
        if ($res) {
            $str="OK+";
        	@header("Content-type:text/plain;charset=UTF-8");
        	echo $str;
         } else {
            $str="ERROR+";
        	@header("Content-type:text/plain;charset=UTF-8");
        	echo $str;
         }
    }
    public function sub($str){
        $arr=array();
        $str=trim($str);
        $pos=strpos($str,'+');
        $place=strpos($str,'=');
        $order=substr($str,$pos+1,$place-$pos-1);
        $sno=substr($str,$place+1);
        $arr['order']=$order;
        $arr['sno']=$sno;
        return $arr;
    }

}