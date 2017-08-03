<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class AdminModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('admin');
	}
    
    public function getAdminByUsername($username='') {
        $res = $this->_db->where('username="'.$username.'"')->find();
        return $res;
    }
    public function getAdminByAdminId($adminId=0) {
        $res = $this->_db->where('admin_id='.$adminId)->find();
        return $res;
    }

    public function updateByAdminId($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('admin_id='.$id)->save($data); // 根据条件更新记录
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        $data['createtime']=time();
        return $this->_db->add($data);
    }

    public function select($data = array(),$page,$pageSize) {
         $data['online'] = array('neq',-1);
          $offset = ($page - 1) * $pageSize;
          $list=$this->_db->where($data)->order('admin_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function getCounts($data= array()) {
        $data['online'] = array('neq',-1);
        return $this->_db->where($data)->count();
    }
    /**
     * 通过id更新的状态
     * @param $id
     * @param $status
     * @return bool
     */
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['status'] = $status;
        return  $this->_db->where('admin_id='.$id)->save($data); 
    }
     public function  updateonlineById($id, $online) {
        if(!is_numeric($online)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['online'] = $online;
        return  $this->_db->where('admin_id='.$id)->save($data); 
    }

    public function getLastLoginUsers() {
        $time = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $data = array(
            'status' => 1,
            'lastlogintime' => array("gt",$time),
        );

        $res = $this->_db->where($data)->count();
        return $res['tp_count'];
    }
    public function find($id){
        if(!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('admin_id='.$id)->find();
    }

}
