<?php

function handelAdcodeAddress($address,$adcode,$is_back=false)
{
	$map['adcode'] = $adcode;
	$area = D('Area')->where($map)->find();
	if(!$is_back)
	{
		$address = $area['name'].$address;
	}
	else
	{
		$address = str_replace($area['name'], '', $address);
	}
	return $address;
}

?>