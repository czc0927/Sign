<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
class LiveController extends Controller {
    public function index() {
           $this->display();
    }
    public function photos(){
    	echo $this->_getphotosutl();
    }
    public function comparison(){
    	$url = 'https://api-cn.faceplusplus.com/facepp/v3/compare';
        $post_data['api_key']  ="zJ2Mp_PL3UPOJKz2jE5EfRvEXe1We1ja";
        $post_data['api_secret']="c7tQ5lfP_4UWeUUn0GsR8EvEM7xvkusW";
        $post_data['image_url1'] =$this->_getphotosutl();
        $post_data['image_url2'] =$this->_getphotosutl();
        $res =$this->request_post($url, $post_data);
         $result=json_decode($res);
        var_dump($result->confidence);
    }
    public function _getphotosutl(){
    	$url = 'https://open.ys7.com/api/lapp/device/capture';
        $post_data['accessToken']  =$this->_getAccessToken();
        $post_data['deviceSerial'] = '724600673';
        $post_data['channelNo'] = '1';
        $res =$this->request_post($url, $post_data);
         $result=json_decode($res);
         return $result->data->picUrl;
    }
    public function _getAccessToken() {
		$url = 'https://open.ys7.com/api/lapp/token/get';
        $post_data['appKey']  = '8b9b3518bea242e38388300ea4326960';
        $post_data['appSecret'] = '5d38912e0fa3db34bc2f68e0d8dc6e95';
        $res =$this->request_post($url, $post_data);
         $result=json_decode($res);
         return $result->data->accessToken;
	}
	public function request_post($url = '', $post_data = array()) {
        if (empty($url) || empty($post_data)) {
            return false;
        }
        
        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        
        return $data;
    }
}