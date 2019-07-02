
<?php
//----------------------------------
// 腾讯验证码后台接入demo
//----------------------------------
header('Content-type:text/html;charset=utf-8');

$AppSecretKey = "0b3Y2vnsjQtorTXYQSy05TQ**"; //$_GET["AppSecretKey"]
$appid = $_GET["appid"];
$Ticket =$_GET["Ticket"];
$Randstr =$_GET["randstr"];
$UserIP = $_GET["UserIP"];
var_dump($UserIP);
/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
*/
function txcurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();

   

    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    
    //var_dump(curl_error($ch));
    //echo $url.'?'.$params;

    $response = curl_exec( $ch );

    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch); 
        
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}

$url = "https://ssl.captcha.qq.com/ticket/verify";
$params = array(
    "aid" => $appid,
    "AppSecretKey" => $AppSecretKey,
    "Ticket" => $Ticket,
    "Randstr" => $Randstr,
    "UserIP" => $UserIP
);

$paramstring = http_build_query($params);

$content = txcurl($url,$paramstring);
//var_dump(txcurl($url,$paramstring));
$result = json_decode($content,true);

if($result){
    if($result['response'] == 1){
        print_r($result);
    }else{
        echo $result['response'].":".$result['err_msg'];
    }
}else{

    echo "请求失败";
}

?>
