<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class AttendModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('Attend');
	}
     public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        $data['wordtime']=time();
        return $this->_db->add($data);
    }
    public function updateByAttendId($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('attend_id='.$id)->save($data); // 根据条件更新记录
    }

    public function select($data = array(),$page,$pageSize) {
         $data['online'] = array('neq',-1);
        if($data['depart_id']==0){
            unset($data['depart_id']);
        }
          $offset = ($page - 1) * $pageSize;
          $list=$this->_db->where($data)->order('attend_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function selectonline($data = array(),$page,$pageSize) {
         $data['online'] = array('eq',-1);
          $offset = ($page - 1) * $pageSize;
          $list=$this->_db->where($data)->order('attend_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    
    public function getCounts($data= array()) {
        $data['online'] = array('neq',-1);
        if($data['depart_id']==0){
            unset($data['depart_id']);
        }
        return $this->_db->where($data)->count();
    }
    public function getonlineCounts($data= array()) {
        $data['online'] = array('eq',-1);
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
        return  $this->_db->where('attend_id='.$id)->save($data); 
    }
     public function  updateonlineById($id, $online) {
        if(!is_numeric($online)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['online'] = $online;
        return  $this->_db->where('attend_id='.$id)->save($data); 
    }
    public function find($id){
        if(!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('attend_id='.$id)->find();
    }

        public function selectday($data = array(),$limit=0) {
         $data['online'] = array('neq',-1);
        if($data['depart_id']==0){
            unset($data['depart_id']);
        }
        if($data['name']) {
            $data['name'] = array('like', '%'.$data['name'].'%');
        }
        $time=time();
        $data['wordtime']=array('egt',$time);
        if($limit) {
            $this->_db->limit($limit);
        }
        $list = $this->_db->where($data)->order('staff_id desc')->select();//1489975200
        return $list;
    }


}
