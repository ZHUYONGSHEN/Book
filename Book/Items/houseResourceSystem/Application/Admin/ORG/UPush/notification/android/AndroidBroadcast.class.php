<?php
namespace Admin\ORG\UPush\notification\android;
use Admin\ORG\UPush\notification\AndroidNotification;

class AndroidBroadcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}