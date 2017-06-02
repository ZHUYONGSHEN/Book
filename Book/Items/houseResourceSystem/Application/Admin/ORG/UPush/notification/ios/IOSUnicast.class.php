<?php
namespace Admin\ORG\UPush\notification\ios;
use Admin\ORG\UPush\notification\IOSNotification;

class IOSUnicast extends IOSNotification {
	function __construct() {
		parent::__construct();
		$this->data["type"] = "unicast";
		$this->data["device_tokens"] = NULL;
	}

}