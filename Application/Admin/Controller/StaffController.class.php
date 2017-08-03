<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
class StaffController extends CommonController {
    public function index() {
            if(!empty($_GET['name'])){
                $data['name'] = array('like', '%'.trim($_GET['name']).'%');
                $this->assign('name', $_GET['name']);
                }
            if(!empty($_GET['starttime'])&&!empty($_GET['endtime'])&&strtotime($_GET['endtime'])>strtotime($_GET['starttime'])){
                  $data['createtime']=[
                      ['egt',strtotime($_GET['starttime'])],
                      ['elt',strtotime($_GET['endtime'])],
                 ];
                  $this->assign('starttime', $_GET['starttime']);
                  $this->assign('endtime', $_GET['endtime']);
                }
                $data['model']=0;
            $data['depart_id'] = $_GET['depart_id'] ? intval($_GET['depart_id']) :0;
            $model['model']=0;
            $departs = D("Depart")->getNormalDeparts($model);
            $count=D('Staff')->getCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $staffs =D('Staff')->select($data,$page,$pageSize);
           $menusCount =count($staffs);
            $this->assign('Count', $menusCount);
           $this->assign('staffs', $staffs);
             $this->assign('departs', $departs);
             $this->assign('depart_id', $data['depart_id']);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
           $this->display();
    }

    public function add() {
        if(IS_POST) {
            if(!isset($_POST['name']) || !$_POST['name']) {
                $this->error('姓名不能为空');
            }
            if(!isset($_POST['telephone']) || !$_POST['telephone']) {
                 $this->error('手机不能为空');
            }
            if(!isset($_POST['depart_id']) || !$_POST['depart_id']) {
                 $this->error('部门未选择');
            }
            if(!isset($_POST['position']) || !$_POST['position']) {
                 $this->error('职位不能为空');
            }
            if(!empty($_FILES['file']['tmp_name'])){
                  $this->error('图片未上传');
            }
            if($_POST['staff_id']) {
                return $this->save($_POST);
            }
            $user = D("Staff")->getStaffByname($_POST['name']);
            if($user && $user['online']!=-1) {
                $this->error('该员工存在');
            }
            $url=$this->upload();
            if(!$url){
                $this->error('图片上传失败');
            }
            $_POST['url']=$url;
            $id = D("Staff")->insert($_POST);
            if(!$id) {
                 $this->error('新增失败');
            }
            $this->error('新增成功');
        }
        $departs = D("Depart")->getNormalDeparts();
        $this->assign('departs', $departs);
        $this->display();
    }

    public function setStatus() {
        $data = array(
            'id'=>intval($_POST['id']),
            'status'=>intval($_POST['status']),
        );
        $res = D('Staff')->updateStatusById($data['id'],$data['status']);
        if ($res) {
            return show(1, '操作成功');
          } else {
            return show(0, '操作失败');
        }
    }
     public function setonline() {
        $data = array(
            'id'=>intval($_POST['id']),
            'online'=>intval($_POST['online']),
        );
        $res = D('Staff')->updateonlineById($data['id'],$data['online']);
        if ($res) {
            return show(1, '操作成功');
          } else {
            return show(0, '操作失败');
        }
    }
    
    public function edit() {
        $id=$_GET['id'];
        $staff = D("Staff")->getAdminByStaffId($id);
        $departs = D("Depart")->getNormalDeparts();
        $this->assign('departs', $departs);
        $this->assign('staff',$staff);
        $this->display();
    }
     public function save($data) {
        $id = $data['staff_id'];
        unset($data['staff_id']);
        try {
            $id = D("Staff")->updateByStaffId($id, $data);
            if($id === false) {
                return show(0,'更新失败');
            }
            return show(1,'更新成功');
        }catch(Exception $e) {
            return show(0,$e->getMessage());
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
                    $id = D("Staff")->updateonlineById($newsId,-1);
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
     public function loginout(){
        session('adminUser', null);
        $this->redirect('/admin.php?c=login');
     }
     public function del(){
     	 if(!empty($_GET['name'])){
                $data['name'] = array('like', '%'.trim($_GET['name']).'%');
                $this->assign('name', $_GET['name']);
                }
            if(!empty($_GET['starttime'])&&!empty($_GET['endtime'])&&strtotime($_GET['endtime'])>strtotime($_GET['starttime'])){
                  $data['createtime']=[
                      ['egt',strtotime($_GET['starttime'])],
                      ['elt',strtotime($_GET['endtime'])],
                 ];
                  $this->assign('starttime', $_GET['starttime']);
                  $this->assign('endtime', $_GET['endtime']);
                }
                $data['model']=0;
                $count=D('Staff')->getonlineCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $staffs =D('Staff')->selectonline($data,$page,$pageSize);
            $menusCount =count($staffs);
             $this->assign('Count', $menusCount);
             $this->assign('staffs', $staffs);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
     	    $this->display();
     }
     public function upload(){
           $typeArr = array("jpg", "png", "gif");//允许上传文件格式

                $name = $_FILES['photo']['name'];
                $size = $_FILES['photo']['size'];
                $name_tmp = $_FILES['photo']['tmp_name'];
                if (empty($name)) {
                    echo json_encode(array("error"=>"您还未选择图片"));
                    exit;
                }
                $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型

                if (!in_array($type, $typeArr)) {
                    echo json_encode(array("error"=>"清上传jpg,png或gif类型的图片！"));
                    exit;
                }
                /* 
                判断上传图片的大小，演示效果用不到
                if ($size > (1000 * 1024)) {
                    echo json_encode(array("error"=>"图片大小已超过1000KB！"));
                    exit;
                } */
                $pic_name = date('YmdHis').rand(10000, 99999) . "." . $type;//图片名称
                // 用于签名的公钥和私钥
                $accessKey = 'iCGVoD7La5W1ULl70FYOBi7oxjkY6sWXdqwzhPNy';
                $secretKey = 'i2DS5Hs17uyR-VDAqlGds4LpB195vKUKcuqg6D7A';
                require VENDOR_PATH.'/qiniu/autoload.php';
                // 初始化签权对象
                $auth = new Auth($accessKey, $secretKey);   
                // 空间名  https://developer.qiniu.io/kodo/manual/concepts
                $bucket = 'shop';
                // 生成上传Token
                $token = $auth->uploadToken($bucket);
                // 构建 UploadManager 对象
                $uploadMgr = new UploadManager();
                //上传
                list($ret, $err) = $uploadMgr->putFile($token, $pic_name, $name_tmp);
                $url="http://okq9z91is.bkt.clouddn.com/".$ret['key'];
                if ($err !== null) {
                    return false;
                } else {
                    return $url;
                }   
    }

}