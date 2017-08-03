<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class DepartModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('depart');
	}
    
    public function getDepartByname($name='') {
         $res = $this->_db->where('name="'.$name.'"')->find();
        return $res;
    }
    public function getAdminByDepartId($adminId=0) {
        $res = $this->_db->where('depart_id='.$adminId)->find();
        return $res;
    }

    public function updateByDepartId($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('depart_id='.$id)->save($data); // 根据条件更新记录
    }
        public function  updateonlineById($id, $online) {
        if(!is_numeric($online)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['online'] = $online;
        return  $this->_db->where('depart_id='.$id)->save($data); 
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        $randStr = str_shuffle('1234567890');
        $tmp = substr($randStr,0,6);
        $data['createtime']=time();
        $data['sno']=$tmp;
        return $this->_db->add($data);
    }

    public function select($data = array(),$page,$pageSize) {
         $data['online'] = array('neq',-1);
          $offset = ($page - 1) * $pageSize;
          $list=$this->_db->where($data)->order('depart_id desc')->limit($offset,$pageSize)->select();
        return $list;
    } 
    public function getDeparts(){
    	  $data['online'] = array('neq',-1);
          $list=$this->_db->where($data)->select();
        return $list;
    }
    public function getCounts($data= array()) {
        $data['online'] = array('neq',-1);
        if($data['depart_id']==0){
            unset($data['depart_id']);
        }
        return $this->_db->where($data)->count();
    }
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['status'] = $status;
        return  $this->_db->where('depart_id='.$id)->save($data); 
    }
    public function find($id){
        if(!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('depart_id='.$id)->find();
    }
    public function getNormalDeparts($data = array()){
         $data['online'] = array('neq',-1);
         return $this->_db->where($data)->select();
    }

}
