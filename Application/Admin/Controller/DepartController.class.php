<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class DepartController extends CommonController {

    public function index() {
        if(!empty($_GET['name'])){
                $data['name'] = array('like', '%'.trim($_GET['name']).'%');
                $this->assign('name', $_GET['name']);
                }
                $data['model']=0;
            $count=D('Depart')->getCounts($data);
            $p = getpage($count,2);
            $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
            $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 2;
            $departs =D('Depart')->select($data,$page,$pageSize);
            $menusCount =count($departs);
            $this->assign('Count', $menusCount);
            $this->assign('departs', $departs);
            $this->assign('pageRes', $p->show()); // 赋值分页输出
            $this->display();
    }
    public function edit() {
        $Id = $_GET['id'];

        $depart = D("Depart")->find($Id);
        $this->assign('depart', $depart);
        $this->display();
    }
    public function add() {
      if($_POST) {
            if(!isset($_POST['name']) || !$_POST['name']) {
                return show(0,'部门名称');
            }
            if(!isset($_POST['telephone']) || !$_POST['telephone']) {
                return show(0,'部门电话');
            }
            if($_POST['depart_id']) {
                return $this->save($_POST);
            }
            $departId = D("Depart")->insert($_POST);
            if($departId) {
                return show(1,'新增成功',$departId);
            }
            return show(0,'新增失败',$departId);
        }else {
            $this->display();
        }
        
    }

    public function setStatus() {
        $data = array(
            'admin_id'=>intval($_POST['id']),
            'status' => intval($_POST['status']),
        );
        return parent::setStatus($_POST,'Depart');
    }
      public function setonline() {
        $data = array(
            'id'=>intval($_POST['id']),
            'online'=>intval($_POST['online']),
        );
        $res = D('Depart')->updateonlineById($data['id'],$data['online']);
        if ($res) {
            return show(1, '操作成功');
          } else {
            return show(0, '操作失败');
        }
    }
    public function save($data) {
        $departId = $data['depart_id'];
        unset($data['depart_id']);
        try {
            $id = D("Depart")->updateByDepartId($departId, $data);
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
                    $id = D("Depart")->updateonlineById($newsId,-1);
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
}