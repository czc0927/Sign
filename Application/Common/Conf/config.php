<?php
return array(
	//'配置项'=>'配置值'

    //URL地址不区分大小写
    'URL_CASE_INSENSITIVE' =>true,
    'URL_MODEL'=>0,
    'LOAD_EXT_CONFIG' => 'db',
    'HTML_FILE_SUFFIX' => '.html',
    'UPLOAD_SITEIMG_QINIU' => array ( 
                'maxSize' => 5 * 1024 * 1024,//文件大小
                'rootPath' => './',
                'saveName' => array ('uniqid', ''),
                'driver' => 'Qiniu',
                'driverConfig' => array (
                        'accessKey' => 'iCGVoD7La5W1ULl70FYOBi7oxjkY6sWXdqwzhPNy',
                        'secrectKey' => 'i2DS5Hs17uyR-VDAqlGds4LpB195vKUKcuqg6D7A', 
                        'domain' => 'okq9z91is.bkt.clouddn.com',
                        'bucket' => 'shop', 
				            )
				),
);