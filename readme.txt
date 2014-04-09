Block Crawler Instructions

Ensure that you have the following files:

	block_crawler.php - The home page for the script.
	block_crawler.css - The CSS Style Sheet for the script.
	bc_layout.php - This file contains most of the php.html used to render the site.
	bc_daemon.php - This file contains fucntions for interacting with the daemon.


Find the bc_daemon.php and open it in your test editor or PHP IDE.  At the
top you will find the following code:

/******************************************************************************
	Wallet Configuration
******************************************************************************/
	$GLOBALS["wallet_ip"] = "127.0.0.1";
	$GLOBALS["wallet_port"] = "8332";
	$GLOBALS["wallet_user"] = "username";
	$GLOBALS["wallet_pass"] = "password";
	
It is important to replace these values with the correct information for your daemon.

The daemon will work with RPCSSL configured if your version of cURL supports it.

Here are some sample entries for the value $GLOBALS["wallet_ip"]:

	"127.0.0.1" - This will communitcate with the daemon in clear text
	"http://127.0.0.1" - This is also an unencrypted connection
	"https://127.0.0.1" - This will connect to the wallet using SSL encryption.

Once you have made these changes upload the files to your server. You should be ready to go.

/*****************************************************************************
	Updated 07/08/2013
*****************************************************************************/
	-Added file bc_api.php

		This file contains a pass through request API that allows a user or 
		remote script to query the Block Crawler directly for information about the 
		status of the network and the daemon.
