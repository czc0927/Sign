<?php
class AliMsgSend{
	private $phone=null;
	private $code=null;
	public function __construct($phone,$code){
		$this->phone=$phone;
		$this->code=$code;
	}
	public function __call($name,$arguments){
        return "The function is not exits!";
	}
	public function sendMsg(){
		require_once "AlibabaAliqinFcSmsNumSendRequest.php";
		require_once "RequestCheckUtil.php";
		require_once "ResultSet.php";
		require_once "TopClient.php";
		require_once "TopLogger.php";

		    $c = new TopClient;
			$c ->appkey = '23574085' ;
			$c ->secretKey = '869f644f2d38f2d90a69598fb16c57ab';
			$req = new AlibabaAliqinFcSmsNumSendRequest;
			$req ->setExtend( "" );
			$req ->setSmsType( "normal" );
			$req ->setSmsFreeSignName( "智能云锁" );
		    $req ->setSmsParam( "{\"code\":\"".$this->code."\"}");
			$req ->setRecNum($this->phone);
			$req ->setSmsTemplateCode( "SMS_57290063" );
			$resp = $c ->execute($req);
			  if($resp->result->success)
		    {
		        return true;
		    }
		    else
		    {
		        return false;
		    }
	}

}