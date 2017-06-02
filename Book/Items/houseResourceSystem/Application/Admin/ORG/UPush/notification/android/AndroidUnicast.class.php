<?php
namespace Admin\ORG\UPush\notification\android;
use Admin\ORG\UPush\notification\AndroidNotification;

class AndroidUnicast extends AndroidNotification {
	function __construct() {
		parent::__construct();
		$this->data["type"] = "unicast";
		$this->data["device_tokens"] = NULL;
	}

}