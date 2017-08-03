<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
class AdminController extends CommonController {
    public function index() {
            if(!empty($_GET['name'])){
                $data['realname'] = array('like', '%'.trim($_GET['name']).'%');
                $this->assign('name', $data['name']);
                }
            if(!empty($_GET['starttime'])&&!empty($_GET['endtime'])&&strtotime($_GET['endtime'])>strtotime($_GET['starttime'])){
                  $data['createtime']=[
                      ['egt',strtotime($_GET['starttime'])],
                      ['elt',strtotime($_GET['endtime'])],
                 ];
                  $this->assign('starttime', $_GET['starttime']);
                  $this->assign('endtime', $_GET['endtime']);
                }
            $count=D('Admin')->getCounts($data);
            $p = getpage($count,3);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3;
            $admins =D('Admin')->select($data,$page,$pageSize);
           $menusCount =count($admins);
            $this->assign('Count', $menusCount);
            $this->assign('admins', $admins);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
           $this->display();
    }

    public function add() {

        // 保存数据
        if(IS_POST) {

            if(!isset($_POST['username']) || !$_POST['username']) {
                return show(0, '用户名不能为空');
            }
            if(!isset($_POST['password']) || !$_POST['password']) {
                return show(0, '密码不能为空');
            }
            if(!isset($_POST['password2']) || !$_POST['password2']) {
                return show(0, '用户名不能为空');
            }
            if(!isset($_POST['realname']) || !$_POST['realname']) {
                return show(0, '密码不能为空');
            }
            if(!isset($_POST['email']) || !$_POST['email']) {
                return show(0, '用户名不能为空');
            }
            if($_POST['password2']!=$_POST['password']) {
                return show(0, '确认密码不匹配');
            }
            $_POST['password'] = getMd5Password($_POST['password']);
            // 判定用户名是否存在
            $admin = D("Admin")->getAdminByUsername($_POST['username']);
            if($admin && $admin['online']!=-1) {
                return show(0,'该管理员存在');
            }
            // 新增
            $id = D("Admin")->insert($_POST);
            if(!$id) {
                return show(0, '新增失败');
            }
            return show(1, '新增成功');
        }
        $this->display();
    }

    public function setStatus() {
        $data = array(
            'id'=>intval($_POST['id']),
            'status'=>intval($_POST['status']),
        );
        $res = D('Admin')->updateStatusById($data['id'],$data['status']);
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
        $res = D('Admin')->updateonlineById($data['id'],$data['online']);
        if ($res) {
            return show(1, '操作成功');
          } else {
            return show(0, '操作失败');
        }
    }
    
    public function personal() {
        $res = $this->getLoginUser();
        $user = D("Admin")->getAdminByAdminId($res['admin_id']);
        $this->assign('admin',$user);
        $this->display();
    }
   public function save() {
        $user = $this->getLoginUser();
        if(!$user) {
            return show(0,'用户不存在');
        }
        $data['realname'] = $_POST['realname'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        if($user['password']!=getMd5Password($_POST['password'])){
            return show(0,'原始密码错误');
        }else{
            $data['password']=getMd5Password($_POST['newpassword']);
        }
        try {
            $id = D("Admin")->updateByAdminId($user['admin_id'], $data);
            if($id === false) {
                return show(0, '配置失败');
            }
            return show(1, '配置成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
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
                    $id = D("Admin")->updateonlineById($newsId,-1);
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

}