<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
class AttendController extends CommonController {
    public function index() {
            if(!empty($_GET['name'])){
                $data['name'] = array('like', '%'.trim($_GET['name']).'%');
                $this->assign('name', $_GET['name']);
                }
             $data['model']=0;
             $daytime=date("Y-m-d");
             $time=strtotime($daytime);
            $data['wordtime']=array('egt',$time);
            $data['depart_id'] = $_GET['depart_id'] ? intval($_GET['depart_id']) :0;
           $model['model']=0;
            $Departs = D("Depart")->getNormalDeparts($model);
            $count=D('Attend')->getCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $Attends =D('Attend')->select($data,$page,$pageSize);
            $attlist=array();
            foreach($Attends as $attend){
            	$staff_id=intval($attend['staff_id']);
            	$staff=D('Staff')->find($staff_id);
            	$attend['name']=$staff['name'];
            	$attend['sno']=$staff['sno'];
            	$attend['position']=$staff['position'];
            	$depart_id=intval($staff['depart_id']);
            	$depart=D('Depart')->find($depart_id);
            	$attend['departname']=$depart['name'];
            	$attlist[]=$attend;
            }
            $menusCount =count($Attends);
            $this->assign('Count', $menusCount);
            $this->assign('attends', $attlist);
             $this->assign('departs', $Departs);
             $this->assign('depart_id', $data['depart_id']);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
           $this->display();
    }
    public function record(){
    	 if(!empty($_GET['name'])){
                $data['name'] = array('like', '%'.trim($_GET['name']).'%');
                $this->assign('name', $_GET['name']);
                }
             $time=time();
               $data['model']=0;
            $data['depart_id'] = $_GET['depart_id'] ? intval($_GET['depart_id']) :0;
            $model['model']=0;
            $Departs = D("Depart")->getNormalDeparts($model);
         
            $count=D('Attend')->getCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $Attends =D('Attend')->select($data,$page,$pageSize);
            $attlist=array();
            foreach($Attends as $attend){
            	$staff_id=intval($attend['staff_id']);
            	$staff=D('Staff')->find($staff_id);
            	$attend['name']=$staff['name'];
            	$attend['sno']=$staff['sno'];
            	$attend['position']=$staff['position'];
            	$depart_id=intval($staff['depart_id']);
            	$depart=D('Depart')->find($depart_id);
            	$attend['departname']=$depart['name'];
            	$attlist[]=$attend;
            }
            $menusCount =count($Attends);
            $this->assign('Count', $menusCount);
            $this->assign('attends', $attlist);
             $this->assign('departs', $Departs);
             $this->assign('depart_id', $data['depart_id']);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
           $this->display();
    }
     public function setonline() {
        $data = array(
            'id'=>intval($_POST['id']),
            'online'=>intval($_POST['online']),
        );
        $res = D('Attend')->updateonlineById($data['id'],$data['online']);
        if ($res) {
            return show(1, '操作成功');
          } else {
            return show(0, '操作失败');
        }
    }
    public function listorder(){
        $listorder = $_POST['listorder'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = array();
        try {
            if ($listorder) {
                foreach ($listorder as $newsId) {
                    // 执行更新
                    $id = D("Attend")->updateonlineById($newsId,-1);
                    if ($id === false) {
                        $errors[] = $newsId;
                    }
                }
                if ($errors) {
                    return show(0, '删除失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
                }
                return show(1, '删除成功', array('jump_url' => $jumpUrl));
            }
        }catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0,'删除数据失败',array('jump_url' => $jumpUrl));
        print_r($listorder);
    }
     public function del(){
     	 if(!empty($_GET['name'])){
                $data['name'] = array('like', '%'.trim($_GET['name']).'%');
                $this->assign('name', $_GET['name']);
                }
                  $data['model']=0;
            if(!empty($_GET['starttime'])&&!empty($_GET['endtime'])&&strtotime($_GET['endtime'])>strtotime($_GET['starttime'])){
                  $data['createtime']=[
                      ['egt',strtotime($_GET['starttime'])],
                      ['elt',strtotime($_GET['endtime'])],
                 ];
                  $this->assign('starttime', $_GET['starttime']);
                  $this->assign('endtime', $_GET['endtime']);
                }
                $count=D('Attend')->getonlineCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $Attends =D('Attend')->selectonline($data,$page,$pageSize);
            $attlist=array();
            foreach($Attends as $attend){
            	$staff_id=intval($attend['staff_id']);
            	$staff=D('Staff')->find($staff_id);
            	$attend['name']=$staff['name'];
            	$attend['sno']=$staff['sno'];
            	$attend['position']=$staff['position'];
            	$depart_id=intval($staff['depart_id']);
            	$depart=D('Depart')->find($depart_id);
            	$attend['departname']=$depart['name'];
            	$attlist[]=$attend;
            }
            $menusCount =count($Attends);
             $model['model']=0;
            $Departs = D("Depart")->getNormalDeparts($model);
            $this->assign('Count', $menusCount);
            $this->assign('attends', $attlist);
             $this->assign('departs', $Departs);
             $this->assign('depart_id', $data['depart_id']);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
           $this->display();
     }
}