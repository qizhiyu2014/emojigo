<?php 
namespace Home\Model;
use Think\Model;
	
	class BaseEventModel extends Model {

		//定义数据表名
		protected $tableName = 'event';



		public function deleteEvent($uid,$eid) {
			$event = $this->find($eid);
			if(!$event || $event['uid'] != $uid) {
				return false;
			}
			$model = new Model();
			$prefix = C('DB_PREFIX');
			$model->startTrans();
			$count = $model->table($prefix.'event')->where('id='.$eid)->delete();
			if($count === false) {
				$model->rollback();
				return false;
			
			} else {
					$model->commit();
					return true;
				}
		}

		public function createEvent($uid,$name,$time,$publish,$content) {
			$usermodel = M('user');
			$user = $usermodel->find($uid);
			// if(!$user) {
			// 	return createResult(false,"用户不存在");
			// }
			// if(!validEventName($name)) {
			// 	return createResult(false,"事件名字为1~20个字符");
			// }


			if(is_bool($publish)) {
				$publish = $publish ? 1 : 0;
			} else {
				$publish = 1;
			}

			$timestamp or $timestamp = time();
            $time              = date('Y-m-d H:i:s',$timestamp);

			$data['uid']        = $uid;
			$data['name']       = $name;
			$data['time'] 		= $time;
			$data['publish']    = $publish;
			$data['content']	= $content;

			$id = $this->add($data);

			if($id && $id > 0) {
				$event = $this->find($id);
				return createResult(true,$event);
			} else {
				return createResult(false,"未知错误，请稍后重试");
			}
		}


		public function getMessage($eid, $lastid = 0, $num = 10) {
			$model      = M('message');
			$map['eid'] = array('eq',$eid);
			if($lastid > 0){
				$map['id'] = array('lt',$lastid);
			}
			$list = $model->where($map)->limit($num)->order('publish_time desc')->select();


			return $list === NULL ? array() : $list;
		}

		public function getMessageCount($eid) {
			$model = M('message');
			$map['eid'] = array('eq',$eid);
			$count = $model->where($map)->count();
			return $count === NULL ? 0 : $count;
		}

		public function getUserEvent($uid, $lastid = 0, $num = 10) {
			$model      = M('event');
			$map['uid'] = array('eq',$uid);
			if($lastid > 0){
				$map['id'] = array('lt',$lastid);
			}
			$list = $model->where($map)->limit($num)->order('time desc')->select();

			return $list === NULL ? array() : $list;
		}

		public function eventMessage($uid, $eid, $content) {
			$model      = M('message');

            $timestamp or $timestamp = time();
            $time              = date('Y-m-d H:i:s',$timestamp);

            $data['eid']				= $eid;
			$data['speakerid']        	= $uid;
			$data['publish_time'] 		= $time;
			$data['content']			= $content;
			$data['type']				= 0;

			$id = $model->add($data);

			if($id && $id > 0) {
				$message = $model->find($id);
				return createResult(true,$message);
			} else {
				return createResult(false,"未知错误，请稍后重试");
			}

        }

        public function geteventinfo($eid) {

        	$id = $eid;
            if(empty($id)==true) {
                $result = $this->order('time desc')->find();
                return $result;
            }else{
            	$result = $this->find($id);
            	return $result;
            }

        }

        public function updateEvent($eid, $count) {

        	$event = M('event');
			
			$data['id'] = $eid;
			$data['view_count'] = $count;

			$result = $event->save($data);
			if($result) {
				return createResult(true, $data);
			}else {
				return createResult(false,"未知错误，请稍后重试");
			}


        }








	}
?>