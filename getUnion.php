<?php
$makongUlr = 'http://132.232.19.98/index/api/newNotice?';
$data['money'] = '0.01';//需要生成的金额
$data['desc'] = time(); //生成的备注（订单号、唯一标识....）
$data['account'] = '*******'; //软件账号
$data['pwd'] = '*******'; //软件密码
$data['type'] = 'union'; 
$data['token'] = md5(md5('money='.$data['money'].'&desc='.$data['desc'].'&account='.$data['account'].'&pwd='.$data['pwd']).$data['type']);//验证秘钥
$dataString = http_build_query($data);
$res = curlGetContent($makongUlr.$dataString);
$etime = time();
$resArr = json_decode($res,true);
$status = empty($resArr['status'])?'':$resArr['status'];
if ($resArr && $status == 1){
	$code = $resArr['code']; //二维码 wxp://f2f1OmgO7ADtjB7pw2hCpNSCQTsnv0rj9vFc
	echo $code;
	echo '<br />运行时间';
	echo $etime-$stime;
	//成功添加生成请求
	//执行自己的业务，订单入库等
} else {
	echo $resArr['msg'];
	//错误信息
}

function curlGetContent($makongUlr){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $makongUlr);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
?>
