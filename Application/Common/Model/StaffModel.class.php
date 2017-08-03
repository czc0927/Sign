<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class StaffModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('staff');
	}
    
    public function getStaffByname($name='') {
         $res = $this->_db->where('name="'.$name.'"')->find();
        return $res;
    }
    public function getAdminByStaffId($adminId=0) {
        $res = $this->_db->where('staff_id='.$adminId)->find();
        return $res;
    }
    public function updateStatusBySno($sno,$status){
        $data['status'] = $status;
        return  $this->_db->where('sno='.$sno)->save($data); 
    }

    public function updateByStaffId($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('staff_id='.$id)->save($data); // 根据条件更新记录
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        $year=substr(date("Y"),-2);
        $Counts=$this->getCounts()+100000;
        $count=substr($Counts,-3);
        $data['createtime']=time();
        $data['sno']=$year."".$count;
        return $this->_db->add($data);
    }

    public function select($data = array(),$page,$pageSize) {
         $data['online'] = array('neq',-1);
        if($data['depart_id']==0){
            unset($data['depart_id']);
        }
          $offset = ($page - 1) * $pageSize;
          $list=$this->_db->where($data)->order('staff_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }
    public function selectonline($data = array(),$page,$pageSize) {
         $data['online'] = array('eq',-1);
          $offset = ($page - 1) * $pageSize;
          $list=$this->_db->where($data)->order('staff_id desc')->limit($offset,$pageSize)->select();
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
        return  $this->_db->where('staff_id='.$id)->save($data); 
    }
     public function  updateonlineById($id, $online) {
        if(!is_numeric($online)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['online'] = $online;
        return  $this->_db->where('staff_id='.$id)->save($data); 
    }
    public function find($id){
        if(!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('staff_id='.$id)->find();
    }
      public function isphone($phone){
        $data['telephone'] =$phone;
        $result=$this->_db->where($data)->find();
        if($result){
            return true;
        }else{
            return false;
        }
    }
      public function isOnlineStaffId($adminId=0) {
         $data['online'] = array('neq',-1);
        $res = $this->_db->where('staff_id='.$adminId)->find();
        return $res;
    }
      public function getUserbysno($sno='') {
        $res = $this->_db->where('sno="'.$sno.'"')->find();
        return $res;
    }
     public function getUserbyphone($telephone='') {
        $res = $this->_db->where('telephone="'.$telephone.'"')->find();
        return $res;
    }
     public function getScribes($data=array(),$list=array()){
        $datalist=array();
        foreach ($data as $staff) {
            if(in_array($staff['staff_id'],$list)){
                $staff['scribe']=1;
            }else{
                $staff['scribe']=0;
            }
            $datalist[]=$staff;
        }
        return $datalist;
    }

}
