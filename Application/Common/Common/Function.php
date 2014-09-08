<?php

/**
 * 定义全局方法
 * @author capjason
 */

//引入全局常量
require ('constants.php');


/**
 * 设置在线信息，写入session,包括在线用户类型和在线用户信息
 * @param    integer                   $type 在线用户类型：ONLINE_TYPE_VISITOR  ONLINE_TYPE_USER
 * @param    mixed                   $info 在线用户信息：id,nickname,head_url
 * @author capjason
 * @datetime 2014-07-15T21:01:03+0800
 */
function setOnline($type,$info) {
	session('online_type',$type);
	session('online',$info);
}

/**
 * 获取指定类型在线用户信息
 * @param    integer                   $type 指定用户类型：ONLINE_TYPE_VISITOR ONLINE_TYPE_USER
 * @return   mixed                         指定用户类型的信息：id,nickname,head_url,若没有则返回null
 * @author capjason
 * @datetime 2014-07-15T21:06:05+0800
 */
function getOnline($type) {
	$online_type = session('online_type');
	if(isset($online_type) && $online_type == $type) {
		return session('online');
	} else {
		return null;
	}
}

/**
 * 设置下线
 * @author capjason
 * @datetime 2014-07-15T21:12:04+0800
 */
function setOffline() {
	session('online_type',NULL);
	session('online',NULL);
}

/**
 * 加密用户密码，该方法一经确定就不能修改
 * @param    string                   $password 用户的明文密码
 * @return   string                             加密后的密码
 * @author capjason
 * @datetime 2014-07-15T21:38:27+0800
 */
function encryptPassword($password) {
	return crypt(md5($password),md5("vzhibo"));
}

/**
 * 创建标准返回信息格式，{flag:true,content:..} 或者 {flag:false,message:...}
 * @param    bool                   $flag 返回信息中的flag
 * @param    mixed                   $info [description]
 * @return   mixed                         标准返回信息格式
 * @author capjason
 * @datetime 2014-07-15T21:46:40+0800
 */
function createResult($flag,$info) {
	$rs['flag'] = $flag;
	if(isset($info)) {
		if($flag) {
			$rs['content'] = $info;
		} else {
			$rs['message'] = $info;
		}
	}
	return $rs;
}

/**
 * 判断是否为标准Email地址格式
 * @param    string                   $email 要检测的Email地址
 * @return   bool                          是否为标准Email地址格式
 * @author capjason
 * @datetime 2014-07-15T21:51:40+0800
 */
function validEmail($email) {
	$reg = "/^[\w\d]+[\w\d-.]*@[\w\d-.]+\.[\w\d]{2,10}$/i";
	$match = preg_match($reg, $email);
	return $match ? true : false;
}

/**
 * 判断是否为符合格式要求的昵称
 * @param    string                   $nickname 要检测的昵称
 * @return   bool                             是否为符合格式要求的昵称
 * @author capjason
 * @datetime 2014-07-15T21:54:50+0800
 */
function validNickname($nickname) {
	$len = strlen($nickname);
	return $len >=1 && $len <= 50;
}


/**
 * 检测密码是否符合要求，密码要求为：6~16位字母、数字、下划线、-+!*@#$%^&=等符号的组合
 * @param    string                   $pwd 要检测的密码字符串
 * @return   bool                        是否符合要求
 * @author capjason
 * @datetime 2014-07-15T21:56:31+0800
 */
function validPassword($pwd) {
	$reg = "/^[0-9a-zA-Z_\-\+\!\*\@\#\$\%\^\&\=]{6,16}$/";
	$match = preg_match($reg, $pwd);
	return $match ? true : false;
}

/**
 * 检测电话号码是否符合要求，密码要求为：11位数字的组合
 * @param    string                   $pwd 要检测的密码字符串
 * @return   bool                        是否符合要求
 * @author capjason
 * @datetime 2014-07-15T21:56:31+0800
 */
function validPhone($tel) {
    $reg = "/^13[0-9]\d{8}|15[089]\d{8}|18[056]\d{8}$/";
    $match = preg_match($reg, $tel);
    return $match ? true : false;
}


/**
 * 创建用于app端验证的token
 * @param    string                   $email 用户的邮箱地址
 * @return   string                          token字符串
 * @author capjason
 * @datetime 2014-07-18T16:26:49+0800
 */
function createAppVerifyToken($email) {
	return md5($email.time());
}

/**
 * 判断是否为标准的8位颜色值字符串
 * @param    string                   $str 颜色值
 * @return   bool                        是否为8位颜色值
 * @author capjason
 * @datetime 2014-07-19T16:22:42+0800
 */
function validAlphaColorStr($str) {
	$reg = "/(^[0-9a-fA-F]{8}$)|(^[0-9a-fA-F]{6}$)/";
	$match = preg_match($reg, $str);
	return $match ? true : false;
}


/**
 * 使用phpmailer 发送邮件
 * @param    string                   $address    邮件地址
 * @param    string                   $title      邮件标题
 * @param    string                   $message    邮件内容
 * @param    string                   $fromPrefix 使用的发送方信息配置的前缀
 * @author capjason
 * @datetime 2014-07-19T16:21:44+0800
 */
// function SendMail($address,$title,$message,$fromPrefix = 'VZHIBO')
// {
//     vendor('PHPMailer.class#phpmailer');
//     if($fromPrefix){
//     	$fromPrefix .= '_';
//     }

//     $mail=new PHPMailer();
//     // 设置PHPMailer使用SMTP服务器发送Email
//     $mail->IsSMTP();
//     $mail->IsHTML();
//     $mail->SMTPDebug = false;

//     // 设置邮件的字符编码，若不指定，则为'UTF-8'
//     $mail->CharSet='UTF-8';

//     // 添加收件人地址，可以多次使用来添加多个收件人
//     $mail->AddAddress($address);

//     // 设置邮件正文
//     $mail->Body=$message;

//     // 设置邮件头的From字段。
//     $mail->From=C($fromPrefix.'MAIL_ADDRESS');

//     // 设置发件人名字
//     $mail->FromName=C($fromPrefix.'MAIL_SENDER');
//     // 设置邮件标题
//     $mail->Subject=$title;

//     // 设置SMTP服务器。
//     $mail->Host=C($fromPrefix.'MAIL_SMTP');

//     // 设置为“需要验证”
//     $mail->SMTPAuth=true;

//     // 设置用户名和密码。
//     $mail->Username=C($fromPrefix.'MAIL_LOGINNAME');
//     $mail->Password=C($fromPrefix.'MAIL_PASSWORD');

//     // 发送邮件。
//     return ($mail->Send());

// }

/**
 * 创建用于邮箱验证的token
 * @param    integer                   $uid   用户的id
 * @param    string                   $email 用户的邮箱
 * @return   string                          token字符串
 * @author capjason
 * @datetime 2014-07-19T16:26:13+0800
 */
// function getMailVerifyToken($uid,$email){
// 	return md5('id:'.$uid.'mail:'.$email.time());
// }


/**
 * 判断是否为保留字，防止eventaction里面的方法名字和shortcut冲突
 * @param    string                   $shortcut 待检测shortcut字符串
 * @return   boolean                            是否为保留字
 * @author capjason
 * @datetime 2014-07-18T16:28:29+0800
 */
function isReservedWord($shortcut) {
	$reservedWord = array();
	return in_array($shortcut, $reservedWord);
}

/**
 * 存储一个token和图片key的key-value对
 * @param                             string $token
 * @param                             string $url
 * @author:capjason
 * @datetime:2014-07-21T14:10:08+0800
 */
function setImageUrl($token,$url) {
	session($token,$url);
}
/**
 * 获取存储的key-vlaue对中token对应的value
 * @param                             string $token
 * @return                            string token 对应的图片的key 
 * @author:capjason
 * @datetime:2014-07-21T14:11:08+0800
 */
function getImageUrl($token) {
	return session($token);
}

/**
 * 是否为合法的事件名字
 * @param                             string $name 待检测名称
 * @return                            bool 是否合法
 * @author:capjason
 * @datetime:2014-07-23T14:53:36+0800
 */
function validEventName($name) {
	$len = strlen($name);
	return $len >= 1 && $len <= 60;
}


/**
 * 将时间转化成语义化的时间，如3小时候，2小时前
 * @param                             mixed $time 时间戳或者时间字符串
 * @return                            string 语义化的时间
 * @author:capjason
 * @datetime:2014-07-30T17:57:11+0800
 */
function getSemanticDateTime($time) {
	if(!is_numeric($time)) {
		$time = strtotime($time);
	}
	vendor('Util.SemanticDateTime');
	return SemanticDateTime::parse($time);
}


/**
 * 分词，先去掉标点符号，在分词
 * @param                             string $word 带分词字符串
 * @return                            array 分词结果数组
 * @author:capjason
 * @datetime:2014-07-23T14:54:07+0800
 */
// function splitWord($word) {
// 	if(function_exists("scws_new")) {
// 		//用scws分词，需要提前安装环境
// 		$so = scws_new();
// 		$so->set_charset('utf8');
// 		$so->send_text($word);
// 		//去掉标点符号
// 		$so->set_ignore(true);
// 		while($rs = $so->get_result()) {
// 			foreach ($rs as $key => $value) {
// 				$words[] = $value['word'];
// 			}
// 		}
// 		$so->close();
// 	} else {
// 		//该分词方法对中文支持不好
// 		$word = preg_replace("/[[:punct:]]/",' ',$word);
// 		$word = trim($word);
// 		vendor('WordSplit.lib_splitword_full');
// 		$sp     = new SplitWord();
// 		$result = $sp->SplitRMM($word);
// 		$sp->Clear();
// 		$words = explode(' ', trim($result));
// 	}
// 	return $words;
// }

/**
 * 创建游客的名称
 * @return   string                   游客名称
 * @author lingao
 * @datetime 2014-07-31T09:42:17+0800
 */
function createVisitor() {
    return '游客'.time().rand(1,10000);
}


?>
