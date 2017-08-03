<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class ScribeModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('scribe');
	}
    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }
    public function deletebyid($id){
         if(!is_numeric($id)) {
            throw_exception("id不能为非数字");
        }
        return  $this->_db->where('describe_id='.$id)->delete();
    }
    public function getdescribes(){
        $arr=$this->_db->select();
        $list=array();
        foreach ($arr as $scribes) {
            $list[]=$scribes['describe_id'];
        }
        return $list;
    }
    /**
     * 通过id更新的状态
     * @param $id
     * @param $status
     * @return bool
     */
}
