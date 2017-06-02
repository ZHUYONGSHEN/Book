<?php
namespace Admin\ORG\UPush\notification\ios;
use Admin\ORG\UPush\notification\IOSNotification;

class IOSGroupcast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "groupcast";
		$this->data["filter"]  = NULL;
	}
}