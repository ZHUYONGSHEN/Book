<?php
namespace Admin\ORG\UPush\notification\ios;
use Admin\ORG\UPush\notification\IOSNotification;
class IOSBroadcast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}