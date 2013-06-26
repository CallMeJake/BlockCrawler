<?php
	function site_header ($title, $auth_list="")
	{
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n\n";
		echo "<head>\n\n";
	
		echo "	<title>".$title."</title>\n\n";
	
		echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"block_crawler.css\">\n\n";
	
		echo "</head>\n";
		echo "<body>\n";
		echo "\n";
		
		echo "	<div id=\"site_head\">\n";
		echo "\n";
		
		echo "		<div id=\"site_head_logo\">\n";
		echo "\n";
		
		echo "			<h1><a href=\"".$_SERVER["PHP_SELF"]."\" title=\"Home Page\">\n";
		echo "				Block Crawler\n";
		echo "			</a></h1>\n";
		echo "			<h3><a href=\"".$_SERVER["PHP_SELF"]."\" title=\"Home Page\">\n";
		echo "				Block Chain Viewer\n";
		echo "			</a></h3>\n";
		echo "\n";
		
		echo "		</div>\n";
		echo "\n";
		
		echo "	</div>\n";
		echo "\n";
		
		echo "	<div id=\"page_wrap\">\n";
		echo "\n";
	}
	
	function site_footer ()
	{
	//	The page_wrap div is opened in the last line of the site_header function.	
		echo "	</div>\n";
		echo "\n";
		
		echo "	<div id=\"donor_box\">\n";
		echo "\n";
		
		echo "		BlockCrawler Script Created By Jake Paysnoe - Donations: 1MoWrpf4DjLiL1ALtE6WAAPfHj1aZt38CE \n";
		
		echo "	</div>\n";
		echo "\n";
		
		echo "</body>\n";
		echo "</html>";
		exit;
	}
	
	function block_detail ($block_id, $hash=FALSE)
	{
		if ($hash == TRUE)
		{
			$raw_block = getblock ($block_id);
		}
		
		else
		{	
			$block_hash = getblockhash (intval ($block_id));
			
			$raw_block = getblock ($block_hash);
		}
		
		echo "	<div class=\"block_banner\">\n";
		echo "\n";
		
		echo "		<div class=\"blockbanner_left\">\n";
		echo "			Block Height: ".$raw_block["height"]."\n";
		echo "		</div>\n";
		echo "\n";
		
		echo "		<div class=\"blockbanner_right\">\n";
		echo "			Block Time: ".date ("F j, Y, H:i:s", $raw_block["time"])."\n";
		echo "		</div>\n";
		echo "\n";

		echo "	</div>\n";
		echo "\n";
		
		echo "	<div class=\"blockdetail\">\n";
		echo "\n";
		
		echo "		<div class=\"blockdetail_detail\">\n";
		echo "			<div class=\"blockdetail_header\">Block Version</div>\n";		
		echo "			<div class=\"blockdetail_content\">\n";
		echo "				".$raw_block["version"]."\n";
		echo "			</div>\n";		
		echo "		</div>\n";
		echo "\n";
		
		echo "		<div class=\"blockdetail_detail\">\n";
		echo "			<div class=\"blockdetail_header\">Block Size</div>\n";		
		echo "			<div class=\"blockdetail_content\">\n";
		echo "				".$raw_block["size"]."\n";
		echo "			</div>\n";		
		echo "		</div>\n";
		echo "\n";
		
		echo "		<div class=\"blockdetail_detail\">\n";
		echo "			<div class=\"blockdetail_header\"># of Confirmations</div>\n";		
		echo "			<div class=\"blockdetail_content\">\n";
		echo "				".$raw_block["confirmations"]."\n";
		echo "			</div>\n";		
		echo "		</div>\n";
		echo "\n";
		
		echo "	</div>\n";
		echo "\n";
		
		echo "	<div class=\"blockdetail\">\n";
		echo "\n";
		
		echo "		<div class=\"blockdetail_detail\">\n";
		echo "			<div class=\"blockdetail_header\">Block Bits</div>\n";		
		echo "			<div class=\"blockdetail_content\">\n";
		echo "				".$raw_block["bits"]."\n";
		echo "			</div>\n";		
		echo "		</div>\n";
		echo "\n";
		
		echo "		<div class=\"blockdetail_detail\">\n";
		echo "			<div class=\"blockdetail_header\">Block Nonce</div>\n";		
		echo "			<div class=\"blockdetail_content\">\n";
		echo "				".$raw_block["nonce"]."\n";
		echo "			</div>\n";		
		echo "		</div>\n";
		echo "\n";
		
		echo "		<div class=\"blockdetail_detail\">\n";
		echo "			<div class=\"blockdetail_header\">Block Difficulty</div>\n";		
		echo "			<div class=\"blockdetail_content\">\n";
		echo "				".$raw_block["difficulty"]."\n";
		echo "			</div>\n";		
		echo "		</div>\n";
		echo "\n";
		
		echo "	</div>\n";
		echo "\n";
		
		detail_display ("Merkle Root", $raw_block["merkleroot"]);
		
		detail_display ("Block Hash", blockhash_link ($raw_block["hash"]));
		
		echo "	<div class=\"blocknav\">\n";
		echo "\n";
		
		echo "		<div class=\"blocknav_prev\">\n";
		echo "			<a href=\"".$_SERVER["PHP_SELF"]."?block_hash=".$raw_block["previousblockhash"]."\" title=\"View Previous Block\"><- Previous Block</a>\n";
		echo "		</div>\n";
		echo "\n";
		
		echo "		<div class=\"blocknav_news\">\n";
		echo "			Block Time: ".date ("F j, Y, g:i a", $raw_block["time"])."\n";
		echo "		</div>\n";
		echo "\n";
		
		echo "		<div class=\"blocknav_next\">\n";
		echo "			<a href=\"".$_SERVER["PHP_SELF"]."?block_hash=".$raw_block["nextblockhash"]."\" title=\"View Next Block\">Next Block -></a>\n";
		echo "		</div>\n";
		echo "\n";
		
		echo "	</div>\n";
		echo "\n";
		
		echo "	<div class=\"txlist_header\">\n";
		echo "		Transactions In This Block\n";		
		echo "	</div>\n";
		echo "\n";
		
		echo "	<div class=\"txlist_wrap\">\n";
		
		foreach ($raw_block["tx"] as $index => $tx)
		{
			echo "		<div class=\"txlist_showtx\" id=\"showtx_".$index."\">\n";
			echo "			<a href=\"".$_SERVER["PHP_SELF"]."?transaction=".$tx."\" title=\"Transaction Details\">\n";
			echo "				".$tx."\n";
			echo "			</a>\n";
			echo "		</div>\n\n";
		}
		
		echo "	</div>\n";
		echo "\n";
		
	}
	
	function tx_detail ($tx_id)
	{
		$raw_tx = getrawtransaction ($tx_id);
		
		section_head ("Transaction: ".$raw_tx["txid"]);
		
		section_subhead ("Detailed Description");

		detail_display ("TX Version", $raw_tx["version"]);
		
		detail_display ("TX Time", date ("F j, Y, H:i:s", $raw_tx["time"]));
		
		detail_display ("Lock Time", $raw_tx["locktime"]);
		
		detail_display ("Confirmations", $raw_tx["confirmations"]);
		
		detail_display ("Block Hash", blockhash_link ($raw_tx["blockhash"]));
		
	//	Florin Coin Feature
		if (isset ($raw_tx["tx-comment"]) && $raw_tx["tx-comment"] != "")
		{
			detail_display ("TX Message", htmlspecialchars ($raw_tx["tx-comment"]));
		}
		
		detail_display ("HEX Data", $raw_tx["hex"], 50);
		
		section_head ("Transaction Inputs");		
		
		foreach ($raw_tx["vin"] as $key => $txin)
		{
			section_subhead ("Input Transaction ".$key);

			if (isset ($txin["coinbase"]))
			{
				detail_display ("Coinbase", $txin["coinbase"]);
		
				detail_display ("Sequence", $txin["sequence"]);
			}
			
			else
			{
				detail_display ("TX ID", tx_link ($txin["txid"]));
		
				detail_display ("TX Output", $txin["vout"]);
		
				detail_display ("TX Sequence", $txin["sequence"]);
		
				detail_display ("Script Sig (ASM)", $txin["scriptSig"]["asm"], 50);
		
				detail_display ("Script Sig (HEX)", $txin["scriptSig"]["hex"], 50);
			}
		}
		
		section_head ("Transaction Outputs");
		
		foreach ($raw_tx["vout"] as $key => $txout)
		{
			section_subhead ("Output Transaction ".$key);
		
			detail_display ("TX Value", $txout["value"]);
		
			detail_display ("TX Type", $txout["scriptPubKey"]["type"]);
		
			detail_display ("Required Sigs", $txout["scriptPubKey"]["reqSigs"]);
		
			detail_display ("Script Pub Key (ASM)", $txout["scriptPubKey"]["asm"], 50);
		
			detail_display ("Script Pub Key (HEX)", $txout["scriptPubKey"]["hex"], 50);
		
			if (isset ($txout["scriptPubKey"]["addresses"]))
			{
				foreach ($txout["scriptPubKey"]["addresses"] as $key => $address);
				{
					detail_display ("Address ".$key, $address);
				}
			}
			
 		}
		
		section_head ("Raw Transaction Detail");
		
		echo "	<textarea name=\"rawtrans\" rows=\"25\" cols=\"80\" style=\"text-align:left;\">\n";
		print_r ($raw_tx);
		echo "	\n</textarea><br><br>\n";
	}

	function detail_display ($title, $data, $wordwrap=0)
	{
		echo "	<div class=\"detail_display\">\n";
		
		echo "		<div class=\"detail_title\">\n";
		echo "			".$title."\n";
		echo "		</div>\n";

		if ($wordwrap > 0)
		{
			echo "		<div class=\"detail_data\">\n";
			echo "			".wordwrap ($data, $wordwrap, "<br>", TRUE)."\n";
			echo "		</div>\n";
		}
		
		else
		{
			echo "		<div class=\"detail_data\">\n";
			echo "			".$data."\n";
			echo "		</div>\n";
		}
		
		echo "	</div>\n";
	}

	function tx_link ($tx_id)
	{
		return "<a href=\"".$_SERVER["PHP_SELF"]."?transaction=".$tx_id."\" title=\"View Transaction Details\">".$tx_id."</a>\n";
	}

	function blockheight_link ($block_height)
	{
		return "<a href=\"".$_SERVER["PHP_SELF"]."?block_height=".$block_height."\" title=\"View Block Details\">".$block_height."</a>\n";
	}

	function blockhash_link ($block_hash)
	{
		return "<a href=\"".$_SERVER["PHP_SELF"]."?block_hash=".$block_hash."\" title=\"View Block Details\">".$block_hash."</a>\n";
	}

	function section_head ($heading)
	{
		echo "		<div class=\"section_head\">\n";
		echo "			".$heading."\n";
		echo "		</div>\n";
		echo "\n";
	}
	
	function section_subhead ($heading)
	{
		echo "		<div class=\"section_subhead\">\n";
		echo "			".$heading."\n";
		echo "		</div>\n";
		echo "\n";
	}
	
/******************************************************************************
	This script is Copyright © 2013 Jake Paysnoe.
	I hereby release this script into the public domain.
	Jake Paysnoe Jun 26, 2013
******************************************************************************/
?>