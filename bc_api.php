<?php
//	Enable the wallet
	require_once ("bc_inclusion.php");
	
//	This API will be a simple pass-through with a single sample
//	of blocking a particular call

//	A check for no request
	if (!isset ($_REQUEST["request"]) || $_REQUEST["request"] == "")
	{
		$error["code"] = 0;
		$error["message"] = "No Request";
		
		print_r (json_encode($error));
		exit;
	}

//	URL formatting is stripped from the request
	$request = urldecode ($_REQUEST["request"]);
	
//	The request is split in case anyone tries to send a multi-parameter
//	request to the API, any parameters after method will be ignored
	$request = explode (" ", $request);
	
//	This is a security check to ensure that no one uses the API
//	to request a balance from the wallet.
//	This check can be duplicated for any other calls you want to block
	if ($request[0] == "getbalance")
	{
		$error["code"] = 1;
		$error["message"] = "Invalid API Request";
		
		print_r (json_encode($error));
		exit;
	}	
	
//	The first word of the request is passed to the daemon as a
//	JSON-RPC method
	$query["method"] = $request[0];
	
//	The data is fetched from the wallet
	$result = wallet_fetch ($query);

//	The wallet fetch routine has removed the JSON formatting for 
//	internal use. The JSON format is re-applied for the the feed
	print_r (json_encode ($result));
	exit;
	
//	That's it.
?>