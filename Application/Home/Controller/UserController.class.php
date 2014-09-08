<?php 
namespace Home\Controller;
use Think\Controller;

	class UserController extends Controller {
		private $handle;

		public function __construct() {
			parent::__construct();
			$this->handle = D('User');
		}

		
		



	}
 ?>