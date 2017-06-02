<?php
namespace Admin\ORG\UPush\notification\android;
use Admin\ORG\UPush\notification\AndroidNotification;

class AndroidGroupcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "groupcast";
		$this->data["filter"]  = NULL;
	}
}