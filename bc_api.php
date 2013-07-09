<?php

/******************************************************************************


	Accessing data via this API is done using HTTP GET requests.
	
	The "request" parameter is to be used for all requests,
	Here is a sample URL requesting "getinfo":

	http://www.sample.com/path_to_Block_Crawler/bc_api?request=getinfo
	
	This API will support all single-parameter JSON-RPC methods
	supported by the satoshi wallet, except those blocked in code.
	
	Several functions regarding wallet balances and transations
	are blocked in the release version of this API.

******************************************************************************/
//	Enable the wallet
	require_once ("bc_daemon.php");
	
//	A check for no request
	if (!isset ($_REQUEST["request"]) || $_REQUEST["request"] == "")
	{
		bcapi_error (0, "No Request");
	}

//	URL formatting is stripped from the request
	$request = urldecode ($_REQUEST["request"]);
	
//	The request is split in case anyone tries to send a multi-parameter
//	request to the API, any parameters after method will be ignored
	$request = explode (" ", $request);
	
//	These are security checks to ensure that no one uses the API
//	to request balance data or mess up the wallet.
	if ($request[0] == "getbalance")
	{
		bcapi_error (1, "Method Not Permitted: getbalance");
	}	
	
	if ($request[0] == "listaccounts")
	{
		bcapi_error (2, "Method Not Permitted: listaccounts");
	}	
	
	if ($request[0] == "listtransactions")
	{
		bcapi_error (3, "Method Not Permitted: listtransactions");
	}	
	
	if ($request[0] == "keypoolrefill")
	{
		bcapi_error (4, "Method Not Permitted: keypoolrefill");
	}	
	
	if ($request[0] == "getpeerinfo")
	{
		bcapi_error (5, "Method Not Permitted: getpeerinfo");
	}	
	
	if ($request[0] == "listreceivedbyaddress")
	{
		bcapi_error (7, "Method Not Permitted: listreceivedbyaddress");
	}	
	
//	Check to stop remote users from killing the daemon via API
	if ($request[0] == "stop")
	{
		bcapi_error (6, "Method Not Permitted: stop");
	}	
	
//	The first word of the request is passed to the daemon as a
//	JSON-RPC method
	$query["method"] = $request[0];
	
//	The data is fetched from the wallet
	$result = wallet_fetch ($query);

//	The wallet fetch routine has removed the JSON formatting for 
//	internal use. The JSON format is re-applied for the the feed
	print_r (json_encode ($result));

//	That's it.
	exit;

//	this function is here to generate repetitive error messages
	function bcapi_error ($code, $message)
	{
		$error["code"] = $code;
		$error["message"] = $message;
		
		print_r (json_encode($error));
		exit;
	}
?>