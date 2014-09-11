<?php
namespace Home\Model;
use Think\Model;

    class EventModel extends BaseEventModel {
        //句柄
        private $event;
        private $user;


        public function __construct() {
            parent::__construct();
            //打开句柄
            $this->event      = M('event');
            $this->user       = M('user');

        }

        /**
         * Get Event Comment
         */

        public function getMessage($eid, $lastid, $num) {
            $eid    = intval($eid);
            $lastid = empty($lastid) ?  0  : intval($lastid);
            $num    = empty($num)    ?  10 : intval($num);
            $list   = parent::getMessage($eid, $lastid, $num);


            foreach ($list as $key => $value) {
                $speaker                = self::getSpeaker($value['speakerid']);
                $value['nickname']  = $speaker['nickname'];

                $list[$key]             = $value;
            
            }
            return $list === NULL ? array() : $list;

        }


        public function getUserEvent($uid, $lastid, $num){

            $result = parent::getUserEvent($uid, $lastid, $num);

            if (is_array($result)) {
                return createResult(true, $result);
            } else {
                 return createResult(false, '未知错误!');
            }

        }

        public function eventMessage($uid, $eid, $content) {

            $eid    = intval($eid);

            $result = parent::eventMessage($uid, $eid, $content);
            

            return $result;
            
        }


        public function createVisitor($nickname) {
            $model = M('visitor');

            $timestamp or $timestamp = time();
            $time              = date('Y-m-d H:i:s',$timestamp);

            $data['nickname']       = $nickname;
            $data['create_time']    = $time;

            $id = $model->add($data);
            $data['id'] = $id;
            return $data;
        }


        public function geteventinfo($eid) {


            $eid    = intval($eid);

            $result = parent::geteventinfo($eid);

            return $result;

        }

        public function getSpeaker($uid) {
            $model = M('visitor');

            $id = $uid;

            $result = $model->find($id);

            return $result;
        }


        public function viewCount($eid) {
            $eid = intval($eid);


            $map['id'] = array('eq',$eid);
            $result = $this->where($map)->select();

            $count = intval($result[0]['view_count']) + 1;


            $result = parent::updateEvent($eid, $count);
            
            return $result;



        }

        public function contentCompare($eid, $content) {
            $eid    = intval($eid);

            $result = parent::contentCompare($eid, $content);

            $rate = floor(($result[0])*10000)/10000*100;

            if ($result[0]==1 && $result[0]==$result[1]) {
                return createResult(right, "恭喜你!完全正确!");
            } else if($result[0]==1) {
                return createResult(wrong, "恭喜你你的回答包含了答案,但是不完全正确");
            } else {
                return createResult(wrong, '恭喜你答对'.$rate.'％');
            }
            

        }




        






    }   
?>