<?php 
namespace Home\Controller;
use Think\Controller;

	class EventController extends Controller {
		//句柄
		private $handle;

		public function __construct() {
			parent::__construct();

			$this->handle = D('event');

		}

		public function _empty($eid) {

			$this->eventpage($eid);
		}

		public function createEvent() {
            $uid        = 1;//$this->getUid();
            $name       = I('name');
            $publish	= 0;// $this->I('publish');
            $content    = I('content');
            $time       = 0;



            $result   = $this->handle->createEvent($uid, $name, $time, $publish, $content);


            if ($result['flag'] !== true) {
              $this->error($result['message']);
            } else {
print_r($result);
//                $this->success('创建成功!');
            }

        }

        public function sendComment() {
            $condition = 1;
            if(empty($_SESSION['id'])) {
                $nickname   = I('name');

                if(!empty($nickname)) {
                    $visitor    = $this->handle->createVisitor($nickname);
                    $uid        = $visitor['id'];

                    $json_visitor = json_encode($visitor);
                    echo($json_visitor);
                }else{
                    echo("name request");
                    $condition = 0;
                }
            }else{
                $uid = $_SESSION['id'];
            }

            if($condition) {
                $eid     		= I('eid');
                $content 		= I('content');

                $result  = $this->handle->eventMessage($uid, $eid, $content);

            }

        }

        public function getMessage() {
            $eid    = I('eid');
            $lastid = I('lastid');
            $lastid = empty($lastid) ? 0: $lastid;

            $result = $this->handle->getMessage($eid, $lastid, $num);
            $json_msg = json_encode($result);
            echo ($json_msg);

            // print_r($result);
            // $this->assign('comment',$result);
            // $this->display('comment');


        }

        public function getUserEvent() {
            $uid        = 1;//$this->getUid();
            $lastid     = 0;
            $result     = $this->handle->getUserEvent($uid);
            if ($result['flag'] !== true) {
                    $this->error($result['message']);
            } else {

                    return $result;
            }
         }

         public function eventpage($eid) {

            session_start();

            $eventinfo = $this->handle->geteventinfo($eid);
            if (!$eventinfo) {
                echo "404 Not Found";
                exit;
            }
            $this->assign('eventinfo',$eventinfo);

            $this->display('index');


         } 

         public function getLocalStorage() {
            $_SESSION['name'] = I('name');
            $_SESSION['id'] = I('uid');

            if(!empty($_SESSION['id'])) {
                echo("you are online");
            }else{
                echo("you are offline");

            }
         }

         public function messageCount() {
            $eid = I('eid');

            $result = $this->handle->getMessageCount($eid);
            echo($result);
         }


         public function updateEventCount() {
            $eid        = I('eid');
            $result     = $this->handle->viewCount($eid);
            $json_msg   = json_encode($result);
            echo($json_msg);

         }









	}
?>