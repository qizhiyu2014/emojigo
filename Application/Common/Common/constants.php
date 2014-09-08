<?php

/**
 * 定义全局常量
 * @author capjason
 */


	//事件状态
	define('EVENT_STATE_NORMAL',1);
	define('EVENT_STATE_LIVE', 2);
	define('EVENT_STATE_ARCHIVE',4);

	//post状态
	define('POST_STATE_INTERRUPTED', 1);
	define('POST_STATE_LIVE', 2);
	define('POST_STATE_SAVED', 4);
	define('POST_STATE_TRANSCODE',8);

	//消息类型
	define('MESSAGE_TYPE_NORMAL', 0);
	define('MESSAGE_TYPE_VISITOR', 1);

	//通知类型
	define('NOTIFICATION_TYPE_SUBSCRIPTION', 0);
	define('NOTIFICATION_TYPE_SYSTEM', 1);

	//用户提醒类型
	define('NOTIFY_TEL', 1);
	define('NOTIFY_MAIL', 2);
	define('NOTIFY_TYPE_MAX', 3);

	//用户类型
	define('USER_TYPE_NORMAL', 0);
	define('USER_TYPE_SNS', 1);

	//社交类型
	define('SNS_TYPE_RENREN', 1);
	define('SNS_TYPE_QQ', 2);
	define('SNS_TYPE_WEIBO', 4);
	define('SNS_TYPE_WECHAT', 8);

	//在线用户类型
	define('ONLINE_TYPE_VISITOR', 0);
	define('ONLINE_TYPE_USER', 1);

	//部分需要的session名字
	define('SESSION_REGISTER_VERIFY', 'register_verify');
	define('SESSION_UPLOAD_HEAD_KEY', 'upload_head_key');
	define('SESSION_UPLOAD_POSTER_KEY', 'upload_poster_key');
	define('SESSION_UPLOAD_BGIMG_KEY', 'upload_bgimg_key');

	define('CONFIG_KEY_DEFAULT_HEAD', 'default_head');

	//图片mimetype
	define('PIC_MIME_TYPE', 'image/jpeg');
?>